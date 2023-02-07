@extends("layouts.app")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        メールアドレス一覧画面
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif
                        @if(count($errors) > 0)
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <p>メールを一斉送信するサービスです。<br/>
                            （利用方法）<br/>
                            １．送信したいアドレスにチェックを入れる。<br/>
                            ２．メッセージ入力項目に送信したいメッセージを記入する<br/>
                            ３．送信ボタンを押す<br/><br/>
                            <strong>※新しいメールアドレスを登録したい場合、「登録」ボタンから登録画面に遷移してください。</strong>
                        </p>
                        <a href="{{ route('email.create') }}" class="btn btn-success mb-3">登録</a>
                        <form method="POST" action="{{ route('email.send') }}" id="send">
                            @csrf
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>id</th>
                                    <th>address</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($emails as $email)
                                <tr>
                                    <td><input type="checkbox" name="mail_send_ids[]" value="{{$email->id}}" form="send" /></td>
                                    <td>{{ $email->id }}</td>
                                    <td>{{ $email->email_address }}</td>
                                    <td>
                                        <input type="button" class="btn btn-sm btn-danger pull-right" id="{{$email->id}}" value="削除" onclick="buttonClick(this.id)" />
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $emails->links() }}
                            </div>
                            <div class="mb-3">
                                <label for="mail_send_message" class="form-label">メッセージ</label>
                                <textarea class="form-control" id="mail_send_message"
                                          name="mail_send_message" form="send" rows="3" placeholder="メッセージをご記入ください"></textarea>
                            </div>
                            <button class="btn btn-primary mt-3" type="submit" form="send">送信</button>
                        </form>
                        <form method="POST" name="delete" action="">@csrf</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function buttonClick(id){
        const url = "{{ route('email.delete', '*') }}".replace('*', id);
        const form = document.forms["delete"];
        form.action = url
        form.submit();
    }
</script>
@endsection
