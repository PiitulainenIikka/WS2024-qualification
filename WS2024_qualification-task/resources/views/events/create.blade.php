@include('includes.head')
@include('includes.header')
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="{{url('/events')}}">Manage Events</a></li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manage Events</h1>
            </div>

            <div class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Create new event</h2>
                </div>
            </div>

            <form class="needs-validation" novalidate action="{{ url('api/events/create')}}" method="post">

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputName">Name</label>
                        <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                        <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="inputName" name="name" placeholder="" value="">
                        
                        <div class="invalid-feedback">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputSlug">Slug</label>
                        <input type="text" class="form-control {{$errors->has('slug') ? 'is-invalid' : ''}}" id="inputSlug" name="slug" placeholder="" value="">
                        <div class="invalid-feedback">
                            @error('slug')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputDate">Date</label>
                        <input type="date"
                               class="form-control {{$errors->has('date') ? 'is-invalid' : ''}}"
                               id="inputDate"
                               name="date"
                               placeholder="yyyy-mm-dd"
                               value="">
                        <div class="invalid-feedback">
                            @error('date')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                @if (session()->has('status'))
                    <div>
                        <p>{{ session('status') }}</p>
                    </div>
                @endif
                <hr class="mb-4">
                <button class="btn btn-primary" type="submit">Save event</button>
                <a href="{{ url('events') }}" class="btn btn-link">Cancel</a>
            </form>

        </main>
    </div>
</div>

</body>
</html>
