@extends("layouts.app")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        登録画面
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('email.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email_address" class="control-label">メールアドレス</label>
                                <input class="form-control" name="email_address" type="text">
                                @if($errors->has('email_address'))
                                <div class="error mt-3">
                                    <p class="text-danger">{{ $errors->first('email_address') }}</p>
                                </div>
                                @endif
                            </div>
                            <button class="btn btn-primary mt-3" type="submit">登録</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
