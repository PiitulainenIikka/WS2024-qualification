@include('includes.head')
@include('includes.header')
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="/events">Manage Events</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>{{ $event->name}}</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="/events">Overview</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Reports</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item"><a class="nav-link" href="/events">Room capacity</a></li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="border-bottom mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h1 class="h2">{{ $event->name}}</h1>
                </div>
            </div>

            <form class="needs-validation" novalidate action="{{url('api/events/edit/'. $event->id)}}" method="POST">

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputName">Name</label>
                        <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                        <input type="text" name="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="inputName" placeholder="" value={{$event->name}}>
                        <div class="invalid-feedback">
                            @error('slug')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputSlug">Slug</label>
                        <input type="text" name="slug" class="form-control {{$errors->has('slug') ? 'is-invalid' : ''}}" id="inputSlug" placeholder="" value={{$event->slug}}>
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
                        <input type="text"
                               class="form-control {{$errors->has('date') ? 'is-invalid' : ''}}"
                               id="inputDate"
                               name="date"
                               placeholder="yyyy-mm-dd"
                               value={{$event->date}}>
                               
                            <div class="invalid-feedback">
                                @error('date')
                                    {{ $message }}
                                @enderror
                            </div>
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary" type="submit">Save</button>
                <a href="/events" class="btn btn-link">Cancel</a>
            </form>

        </main>
    </div>
</div>

</body>
</html>
