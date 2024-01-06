@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <div class="page-content">
        <div class="row profile-body">
            <!-- left wrapper start -->
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Add Permission </h6>
                            <form id="myForm" method="POST" action="{{ route('update.permission') }}" class="forms-sample">
                                @csrf
                                <input type="hidden" name="id" value="{{ $permission->id }}">
                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Permission Name </label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $permission->name }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Group Name </label>
                                    <select name="guard_name" class="form-select" id="exampleFormControlSelect1">
                                        <option selected="" disabled="">Select Group</option>
                                        <option value="type" {{ $permission->guard_name == 'type' ? 'selected' : '' }}>
                                            Property Type</option>
                                        <option value="state" {{ $permission->guard_name == 'state' ? 'selected' : '' }}>
                                            State</option>
                                        <option value="amenities"
                                            {{ $permission->guard_name == 'amenities' ? 'selected' : '' }}>Amenities
                                        </option>
                                        <option value="property"
                                            {{ $permission->guard_name == 'property' ? 'selected' : '' }}>Property</option>
                                        <option value="history"
                                            {{ $permission->guard_name == 'history' ? 'selected' : '' }}>Package History
                                        </option>
                                        <option value="message"
                                            {{ $permission->guard_name == 'message' ? 'selected' : '' }}>Property Message
                                        </option>
                                        <option value="testimonials"
                                            {{ $permission->guard_name == 'testimonials' ? 'selected' : '' }}>Testimonials
                                        </option>
                                        <option value="agent" {{ $permission->guard_name == 'agent' ? 'selected' : '' }}>
                                            Manage Agent</option>
                                        <option value="category"
                                            {{ $permission->guard_name == 'category' ? 'selected' : '' }}>Blog Category
                                        </option>
                                        <option value="post" {{ $permission->guard_name == 'post' ? 'selected' : '' }}>
                                            Blog Post</option>
                                        <option value="comment"
                                            {{ $permission->guard_name == 'comment' ? 'selected' : '' }}>Blog Comment
                                        </option>
                                        <option value="smtp" {{ $permission->guard_name == 'smtp' ? 'selected' : '' }}>
                                            SMTP Setting</option>
                                        <option value="site" {{ $permission->guard_name == 'site' ? 'selected' : '' }}>
                                            Site Setting</option>
                                        <option value="role" {{ $permission->guard_name == 'role' ? 'selected' : '' }}>
                                            Role & Permission </option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Save Changes </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->
            <!-- right wrapper end -->
        </div>
    </div>
@endsection
