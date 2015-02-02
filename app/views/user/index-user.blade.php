@extends(Config::get('syntara::views.master'))

@section('content')
    <script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script>
    <style type="text/css">
        #search-form .form-group label {
            display: block
        }
    </style>
    <div class="container" id="main-container">
        @include('syntara::layouts.dashboard.confirmation-modal', array('title' => trans('syntara::all.confirm-delete-title'), 'content' => trans('syntara::all.confirm-delete-message'), 'type' => 'delete-user'))
        <div class="row">
            <div class="col-lg-12">
                <section class="module">
                    <div class="module-head">
                        <b>{{ trans('syntara::all.search') }}</b>
                    </div>
                    <div class="module-body">
                        <form id="search-form" onsubmit="return false;" class="form-inline">
                           {{-- <div class="form-group">
                                <label for="userIdSearch">{{ trans('syntara::users.id') }}</label>
                                <input type="text" class="form-control" id="userIdSearch" name="userIdSearch">
                            </div>--}}
                            <div class="form-group">
                                <label for="usernameSearch">{{ trans('syntara::users.username') }}</label>
                                <input type="text" class="form-control" id="usernameSearch" name="usernameSearch">
                            </div>
                            <div class="form-group">
                                <label for="emailSearch">{{ trans('syntara::all.email') }}</label>
                                <input type="email" class="form-control" id="emailSearch" name="emailSearch">
                            </div>
                            <div class="form-group">
                                <label for="lastNameSearch">{{ trans('syntara::users.last-name') }}</label>
                                <input type="text" class="form-control" id="lastNameSearch" name="lastNameSearch">
                            </div>
                            <div class="form-group">
                                <label for="firstNameSearch">{{ trans('syntara::users.first-name') }}</label>
                                <input type="text" class="form-control" id="firstNameSearch" name="firstNameSearch">
                            </div>
                            <div class="form-group">
                                <label for="bannedSearch">{{ trans('syntara::users.banned') }}</label>
                                <select class="form-control" id="bannedSearch" name="bannedSearch">
                                    <option value="">--</option>
                                    <option value="0">{{ trans('syntara::all.no') }}</option>
                                    <option value="1">{{ trans('syntara::all.yes') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php $groups = Sentry::getGroupProvider()->findAll();?>
                                <label for="groupSearch">User Type</label>
                                <select class="form-control" id="groupSearch" name="groupSearch">
                                    <option value="">--</option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->getId()}}">{{$group->getName()}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit"
                                        class="btn btn-primary">{{ trans('syntara::all.search') }}</button>
                            </div>

                        </form>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class="module">
                    <div class="module-head">
                        <b>{{ trans('syntara::users.all') }}</b>
                    </div>
                    <div class="module-body ajax-content">
                        @include(Config::get('syntara::views.users-list'))
                    </div>
                </section>
            </div>

        </div>

    </div>
@stop