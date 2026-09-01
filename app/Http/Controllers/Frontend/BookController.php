<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $query = Book::where('status', 'active');

        // Apply category filter if selected
        if (request()->has('category') && request()->get('category')) {
            $selectedCategories = explode(',', request()->get('category'));
            if (!in_array('all', $selectedCategories)) {
                $categoryIds = [];
                foreach ($selectedCategories as $categorySlug) {
                    $category = BookCategory::where('slug', trim($categorySlug))->first();
                    if ($category) {
                        $categoryIds[] = $category->id;
                    }
                }
                if (!empty($categoryIds)) {
                    $query->whereIn('book_category_id', $categoryIds);
                }
            }
        }

        // Apply author filter if selected
        if (request()->has('author') && request()->get('author')) {
            $selectedAuthors = explode(',', request()->get('author'));
            if (!in_array('all', $selectedAuthors)) {
                $authorIds = [];
                foreach ($selectedAuthors as $authorSlug) {
                    $author = Author::where('slug', trim($authorSlug))->first();
                    if ($author) {
                        $authorIds[] = $author->id;
                    }
                }
                if (!empty($authorIds)) {
                    $query->whereIn('author_id', $authorIds);
                }
            }
        }

        // Apply publisher filter if selected
        if (request()->has('publisher') && request()->get('publisher')) {
            $selectedPublishers = explode(',', request()->get('publisher'));
            if (!in_array('all', $selectedPublishers)) {
                $publisherIds = [];
                foreach ($selectedPublishers as $publisherSlug) {
                    $publisher = Publisher::where('slug', trim($publisherSlug))->first();
                    if ($publisher) {
                        $publisherIds[] = $publisher->id;
                    }
                }
                if (!empty($publisherIds)) {
                    $query->whereIn('publisher_id', $publisherIds);
                }
            }
        }

        $books = $query->with(['bookCategory', 'author', 'publisher'])->latest()->paginate(12);
        $featuredBooks = Book::where('is_featured', true)->where('status', 'active')->latest()->take(6)->get();

        // Get categories that have active books
        $categoryIds = Book::where('status', 'active')->whereNotNull('book_category_id')->pluck('book_category_id')->unique();
        $categories = BookCategory::whereIn('id', $categoryIds)->where('status', 'active')->get();

        // Get authors that have active books
        $authorIds = Book::where('status', 'active')->whereNotNull('author_id')->pluck('author_id')->unique();
        $authors = Author::whereIn('id', $authorIds)->where('status', 'active')->get();

        // Get publishers that have active books
        $publisherIds = Book::where('status', 'active')->whereNotNull('publisher_id')->pluck('publisher_id')->unique();
        $publishers = Publisher::whereIn('id', $publisherIds)->where('status', 'active')->get();

        return view('frontend.pages.books.index', compact('books', 'featuredBooks', 'categories', 'authors', 'publishers'));
    }

    public function show($slug)
    {
        $book = Book::where('slug', $slug)->where('status', 'active')->firstOrFail();
        $relatedBooks = Book::where('id', '!=', $book->id)
            ->where('status', 'active')
            ->where(function ($query) use ($book) {
                $query->where('book_category_id', $book->book_category_id)
                    ->orWhere('author_id', $book->author_id);
            })
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.pages.books.show', compact('book', 'relatedBooks'));
    }
}
