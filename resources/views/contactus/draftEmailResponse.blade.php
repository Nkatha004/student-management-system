@include('dashboard.dashboardSideNav')

<main>
    
    <form method = "post" action = "{{ url('/sendemailresponse') }}" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <h3 class = "text-center">Email Response</h3>
        
        <input type = "text" value = "{{$contact->id}}" hidden name = "contactID">
        <div class="col-12">
            @if($errors->has('sentMessage'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('sentMessage') }}
                </div>
            @endif
            <label for="sentMessage" class="form-label">Received Message</label>
        </div>
        <div class="form-floating">
            <textarea readonly class="form-control" id="sentMessage" name = "sentMessage">{{ $contact->message }}</textarea>
        </div>

        <div class="col-12">
            @if($errors->has('responseBody'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('responseBody') }}
                </div>
            @endif
            <label for="responseBody" class="form-label">Email Response Body</label>
        </div>
        <div class="form-floating">
            <textarea class="form-control" id="responseBody" name = "responseBody" style="height: 100px"></textarea>
        </div>
        
        <div class="col-12 text-center">
            <button type="submit">Send Email</button>
        </div>
    </form>
</main>