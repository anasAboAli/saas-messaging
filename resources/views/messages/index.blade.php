<h2>Messages</h2>

<form method="POST" action="/send">
    @csrf
    <input type="text" name="receiver_id" placeholder="Receiver ID">
    <input type="text" name="content" placeholder="Message">
    <button type="submit">Send</button>
</form>

<hr>

@foreach($messages as $msg)
    <p>{{ $msg->content }}</p>
@endforeachphp artisan serve