<a id="set_edit_user" href="#modalEditUser" class="text-decoration-none myicon rounded-circle p-1"
    data-bs-toggle="modal"
    data-username="{{$user->username}}"
    data-nama="{{$user->nama}}"
    data-email="{{$user->email}}"
    data-verify="{{$user->email_verified_at}}"
    data-level="{{$user->level}}"
    data-token="{{$user->remember_token}}"
    data-dibuat="{{$user->created_at}}"
    data-diupdate="{{$user->updated_at}}">
    <img class="img-fluid" src="{{asset('assets/icons/edit-2.svg')}}" alt="">
</a>

<a id="set_dtl_user" href="#modalDetailUser" class="text-decoration-none myicon rounded-circle p-1"
    data-bs-toggle="modal"
    data-username="{{$user->username}}"
    data-nama="{{$user->nama}}"
    data-email="{{$user->email}}"
    data-verify="{{$user->email_verified_at}}"
    data-level="{{$user->level}}"
    data-token="{{$user->remember_token}}"
    data-dibuat="{{$user->created_at}}"
    data-diupdate="{{$user->updated_at}}">
    <img class="img-fluid" src="{{asset('assets/icons/eye.svg')}}" alt="">
</a>