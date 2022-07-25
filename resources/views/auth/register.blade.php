
<x-layout>
    <x-slot name="title">Rapido - Register</x-slot>
    <!-- ======= FORM LOGIN ======= -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <!--FORM TITLE -->
                <h2 class="form-title space-around">REGISTER</h2>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!--FORM FIELDS -->
                <form action="/register" method="POST" role="form" class="form-control">
                    @csrf
                     <!--Name -->
                     <div class="my-2">
                        <input type="text" name="name" id="name" class="form-control forms_field-input"
                        placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                        <div class="validate"></div>
                    </div>
                    <!--Email -->
                    <div class="my-2">
                        <input type="email" name="email" id="email" class="form-control forms_field-input"
                        placeholder="Your Email" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                        <div class="validate"></div>
                    </div>
                    <!--Password -->
                    <div class=" my-2">
                        <input type="password" name="password" id="password" class="form-control forms_field-input"
                        placeholder="Your Password">
                        <div class="validate"></div>
                    </div>
                    <div class=" my-2">
                        <input type="password" name="password_confirmation" id="password" class="form-control forms_field-input"
                        placeholder="Confirm Password">
                        <div class="validate"></div>
                    </div>
                    <!--Button-Login-->
                    <button type="submit" class="btn btn-info">
                        Register
                    </button>
                </form>
                
                <p class="my-3">Are you member? <a class="btn btn-info btn-sm ms-2" href="{{route('register')}}"><u>Log in!</u></a> </p>
            </div>
        </div>
    </div>
</x-layout>