@if ($errors->any())
    <div class="alert alert-danger" style="color: red; margin-bottom: 15px;">
        <ul style="margin: 0; padding-left: 18px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
