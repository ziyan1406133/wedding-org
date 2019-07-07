@foreach($users as $user)
    <div class="d-flex flex-row mb-3">
        <a class="d-block position-relative" href="/user/{{$user->id}}">
            <img src="{{ asset('/storage/avatar/'.$user->avatar)}}" alt="Marble Cake" class="list-thumbnail border-0" />
        </a>
        <div class="pl-3 pt-2 pr-2 pb-2">
            <a href="/user/{{$user->id}}">
                <p class="list-item-heading">{{$user->name}}</p>
                <div class="pr-4 d-none d-sm-block">
                    <p class="text-muted mb-1 text-small">
                        @if($user->address != NULL)
                            {{$user->address}}, 
                            {{ucwords(strtolower($user->district['name']))}}, 
                            {{ucwords(strtolower($user->regency['name']))}}, 
                            {{ucwords(strtolower($user->province['name']))}}
                        @else
                            Alamat belum diisi.
                        @endif
                    </p>
                </div>
                <div class="text-primary text-small font-weight-medium d-none d-sm-block">Bergabung pada {{date('d/m/20y', strtotime($user->created_at))}}</div>
            </a>
        </div>
    </div>
@endforeach
{{$users->links()}}