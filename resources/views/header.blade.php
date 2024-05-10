<header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <p>{{ __('strings.Registration Web Page')}}</p>
    <nav>
        <ul>
        <div class="header-div">
            <li><a href="https://github.com/rawwaanntarekk/Registration-webpage/tree/main">{{__('strings.Home')}}</a></li>
            <li><a href="https://github.com/rawwaanntarekk/Registration-webpage/tree/main">{{__('strings.About')}}</a></li>
            <li><a href="https://github.com/rawwaanntarekk/Registration-webpage/tree/main">{{__('strings.Contact')}}</a></li>
            <select id="languages">
                <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>{{ __('strings.Arabic')}}</option>
                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>{{ __('strings.English')}}</option>
            </select>
            </div>
        </ul>
    </nav>
</header>