<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['bookCategory', 'author', 'publisher'])->orderBy('id', 'desc')->get();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = BookCategory::where('status', 'active')->get();
        $authors = Author::where('status', 'active')->get();
        $publishers = Publisher::where('status', 'active')->get();
        return view('admin.books.create', compact('categories', 'authors', 'publishers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|unique:books',
            'name_ar' => 'nullable|unique:books',
            'price' => 'required|numeric',
            'sku' => 'required|unique:books',
            'status' => 'required',
            'book_category_id' => 'nullable|exists:book_categories,id',
            'author_id' => 'nullable|exists:authors,id',
            'publisher_id' => 'nullable|exists:publishers,id',
        ]);

        $book = new Book();
        $book->name_en = $request->name_en;
        $book->name_ar = $request->name_ar;
        $book->sku = $request->sku;
        $book->slug = Str::slug($request->name_en);
        $book->description_en = $request->description_en;
        $book->description_ar = $request->description_ar;
        $book->price = $request->price;
        $book->book_category_id = $request->book_category_id;
        $book->author_id = $request->author_id;
        $book->publisher_id = $request->publisher_id;
        $book->pages = $request->pages;
        $book->language = $request->language;
        $book->published_year = $request->published_year;
        $book->isbn = $request->isbn;
        $book->status = $request->status;
        $book->is_featured = $request->has('is_featured');

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('books', 'public');
            }
            $book->images = $images;
        }

        $book->save();

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {
        $categories = BookCategory::where('status', 'active')->get();
        $authors = Author::where('status', 'active')->get();
        $publishers = Publisher::where('status', 'active')->get();
        return view('admin.books.edit', compact('book', 'categories', 'authors', 'publishers'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'name_en' => 'required|unique:books,name_en,' . $book->id,
            'name_ar' => 'nullable|unique:books,name_ar,' . $book->id,
            'price' => 'required|numeric',
            'sku' => 'required|unique:books,sku,' . $book->id,
            'status' => 'required',
            'book_category_id' => 'nullable|exists:book_categories,id',
            'author_id' => 'nullable|exists:authors,id',
            'publisher_id' => 'nullable|exists:publishers,id',
        ]);

        $book->name_en = $request->name_en;
        $book->name_ar = $request->name_ar;
        $book->sku = $request->sku;
        $book->slug = Str::slug($request->name_en);
        $book->description_en = $request->description_en;
        $book->description_ar = $request->description_ar;
        $book->price = $request->price;
        $book->book_category_id = $request->book_category_id;
        $book->author_id = $request->author_id;
        $book->publisher_id = $request->publisher_id;
        $book->pages = $request->pages;
        $book->language = $request->language;
        $book->published_year = $request->published_year;
        $book->isbn = $request->isbn;
        $book->status = $request->status;
        $book->is_featured = $request->has('is_featured');

        if ($request->hasFile('images')) {
            if ($book->images) {
                foreach ($book->images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
            $images = [];
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('books', 'public');
            }
            $book->images = $images;
        } elseif ($request->has('existing_images')) {
            $book->images = $request->input('existing_images');
        } else {
            $book->images = null;
        }

        $book->save();

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        if ($book->images) {
            foreach ($book->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }
}
