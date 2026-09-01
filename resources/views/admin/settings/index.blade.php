@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">General Settings</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Site Name</label>
                            <input type="text" name="site_name" class="form-control"
                                value="{{ \App\Models\Setting::where('key', 'site_name')->value('value') ?? config('app.name') }}">
                        </div>
                        <div class="form-group">
                            <label>Site Logo</label>
                            <div class="mb-2">
                                @php $logo = \App\Models\Setting::where('key', 'site_logo')->value('value'); @endphp
                                @if($logo)
                                    <img src="{{ asset('storage/app/public/' . $logo) }}" alt="Logo" style="max-height: 50px; background: #eee; padding: 5px;">
                                @else
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="Default Logo" style="max-height: 50px; background: #eee; padding: 5px;">
                                @endif
                            </div>
                            <input type="file" name="site_logo" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label>Contact Email</label>
                            <input type="email" name="contact_email" class="form-control"
                                value="{{ \App\Models\Setting::where('key', 'contact_email')->value('value') }}">
                        </div>
                        <div class="form-group">
                            <label>Contact Phone</label>
                            <input type="text" name="contact_phone" class="form-control"
                                value="{{ \App\Models\Setting::where('key', 'contact_phone')->value('value') }}">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address"
                                class="form-control">{{ \App\Models\Setting::where('key', 'address')->value('value') }}</textarea>
                        </div>
                        <hr>
                        <h6 class="font-weight-bold text-primary">Megamenu Banner Settings</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="font-weight-bold mt-2">English Text</h6>
                                <div class="form-group">
                                    <label>Top Text (e.g. UP TO)</label>
                                    <input type="text" name="menu_banner_top_en" class="form-control" value="{{ \App\Models\Setting::where('key', 'menu_banner_top_en')->value('value') ?? 'UP TO' }}">
                                </div>
                                <div class="form-group">
                                    <label>Discount Text (e.g. 50%)</label>
                                    <input type="text" name="menu_banner_discount_en" class="form-control" value="{{ \App\Models\Setting::where('key', 'menu_banner_discount_en')->value('value') ?? '50%' }}">
                                </div>
                                <div class="form-group">
                                    <label>Bottom Text (e.g. OFF)</label>
                                    <input type="text" name="menu_banner_bottom_en" class="form-control" value="{{ \App\Models\Setting::where('key', 'menu_banner_bottom_en')->value('value') ?? 'OFF' }}">
                                </div>
                                <div class="form-group">
                                    <label>Button Text (e.g. SHOP NOW)</label>
                                    <input type="text" name="menu_banner_button_en" class="form-control" value="{{ \App\Models\Setting::where('key', 'menu_banner_button_en')->value('value') ?? 'SHOP NOW' }}">
                                </div>
                            </div>
                            <div class="col-md-6 text-right" dir="rtl">
                                <h6 class="font-weight-bold mt-2">عربي Text</h6>
                                <div class="form-group">
                                    <label>النص العلوي (مثال: خصم يصل إلى)</label>
                                    <input type="text" name="menu_banner_top_ar" class="form-control text-right" value="{{ \App\Models\Setting::where('key', 'menu_banner_top_ar')->value('value') ?? 'خصم يصل إلى' }}">
                                </div>
                                <div class="form-group">
                                    <label>نص الخصم (مثال: 50%)</label>
                                    <input type="text" name="menu_banner_discount_ar" class="form-control text-right" value="{{ \App\Models\Setting::where('key', 'menu_banner_discount_ar')->value('value') ?? '50%' }}">
                                </div>
                                <div class="form-group">
                                    <label>النص السفلي (مثال: فقط)</label>
                                    <input type="text" name="menu_banner_bottom_ar" class="form-control text-right" value="{{ \App\Models\Setting::where('key', 'menu_banner_bottom_ar')->value('value') ?? 'فقط' }}">
                                </div>
                                <div class="form-group">
                                    <label>نص الزر (مثال: تسوق الآن)</label>
                                    <input type="text" name="menu_banner_button_ar" class="form-control text-right" value="{{ \App\Models\Setting::where('key', 'menu_banner_button_ar')->value('value') ?? 'تسوق الآن' }}">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h6 class="font-weight-bold text-primary">Social Media</h6>
                        <div class="form-group">
                            <label>Facebook URL</label>
                            <input type="text" name="social_facebook" class="form-control"
                                value="{{ \App\Models\Setting::where('key', 'social_facebook')->value('value') }}">
                        </div>
                        <div class="form-group">
                            <label>Twitter URL</label>
                            <input type="text" name="social_twitter" class="form-control"
                                value="{{ \App\Models\Setting::where('key', 'social_twitter')->value('value') }}">
                        </div>
                        <div class="form-group">
                            <label>Instagram URL</label>
                            <input type="text" name="social_instagram" class="form-control"
                                value="{{ \App\Models\Setting::where('key', 'social_instagram')->value('value') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Save General Settings</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Currency Settings</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="currency_rate_usd">USD Rate (Base Currency)</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="currency_rate_usd" name="currency_rate_usd" value="{{ \App\Models\Setting::where('key', 'currency_rate_usd')->value('value') ?? 1 }}" required>
                            <small class="form-text text-muted">Base currency rate (should be 1)</small>
                        </div>

                        <div class="form-group">
                            <label for="currency_rate_sar">SAR Rate</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="currency_rate_sar" name="currency_rate_sar" value="{{ \App\Models\Setting::where('key', 'currency_rate_sar')->value('value') ?? 3.75 }}" required>
                            <small class="form-text text-muted">1 USD = {{ \App\Models\Setting::where('key', 'currency_rate_sar')->value('value') ?? 3.75 }} SAR</small>
                        </div>

                        <!-- <div class="form-group">
                            <label for="currency_rate_pkr">PKR Rate</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="currency_rate_pkr" name="currency_rate_pkr" value="{{ \App\Models\Setting::where('key', 'currency_rate_pkr')->value('value') ?? 280 }}" required>
                            <small class="form-text text-muted">1 USD = {{ \App\Models\Setting::where('key', 'currency_rate_pkr')->value('value') ?? 280 }} PKR</small>
                        </div> -->

                        <button type="submit" class="btn btn-primary">Update Currency Rates</button>
                    </form>

                    <div class="alert alert-info mt-4">
                        <i class="fas fa-info-circle"></i> Update these rates when currency exchange rates change. All prices will be converted automatically.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">SMTP Settings (Email)</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Mail Host</label>
                            <input type="text" name="mail_host" class="form-control"
                                value="{{ \App\Models\Setting::where('key', 'mail_host')->value('value') ?? env('MAIL_HOST') }}">
                        </div>
                        <div class="form-group">
                            <label>Mail Port</label>
                            <input type="text" name="mail_port" class="form-control"
                                value="{{ \App\Models\Setting::where('key', 'mail_port')->value('value') ?? env('MAIL_PORT') }}">
                        </div>
                        <div class="form-group">
                            <label>Mail Username</label>
                            <input type="text" name="mail_username" class="form-control"
                                value="{{ \App\Models\Setting::where('key', 'mail_username')->value('value') ?? env('MAIL_USERNAME') }}">
                        </div>
                        <div class="form-group">
                            <label>Mail Password</label>
                            <input type="password" name="mail_password" class="form-control"
                                value="{{ \App\Models\Setting::where('key', 'mail_password')->value('value') ?? env('MAIL_PASSWORD') }}">
                        </div>
                        <div class="form-group">
                            <label>Mail Encryption</label>
                            <select name="mail_encryption" class="form-control">
                                @php $enc = \App\Models\Setting::where('key', 'mail_encryption')->value('value') ?? env('MAIL_ENCRYPTION'); @endphp
                                <option value="tls" {{ $enc == 'tls' ? 'selected' : '' }}>TLS</option>
                                <option value="ssl" {{ $enc == 'ssl' ? 'selected' : '' }}>SSL</option>
                                <option value="null" {{ $enc == 'null' ? 'selected' : '' }}>None</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mail From Address</label>
                            <input type="email" name="mail_from_address" class="form-control"
                                value="{{ \App\Models\Setting::where('key', 'mail_from_address')->value('value') ?? env('MAIL_FROM_ADDRESS') }}">
                        </div>
                        <div class="form-group">
                            <label>Mail From Name</label>
                            <input type="text" name="mail_from_name" class="form-control"
                                value="{{ \App\Models\Setting::where('key', 'mail_from_name')->value('value') ?? env('MAIL_FROM_NAME') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Email Settings</button>
                    </form>

                    <div class="alert alert-info mt-4">
                        <i class="fas fa-info-circle"></i> After updating SMTP settings, these will override your <code>.env</code> file values at runtime.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
