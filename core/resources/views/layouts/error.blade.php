@if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="list-style:none;">{{ __($error) }}</li>
            @endforeach
        </ul>
    </div>
@endif