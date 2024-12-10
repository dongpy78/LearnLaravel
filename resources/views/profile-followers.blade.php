<x-profile :sharedData="$sharedData">
  <div class="list-group">
        @foreach($followers as $follow)
        <a href="/profile/{{$follow->userDoingTheFollowing->username}}"  class="list-group-item list-group-item-action">
          <img style="width: 32px; height: 32px; border-radius: 16px" class="avatar-tiny" src="{{$follow->userDoingTheFollowing->avatar}}" />
          {{$follow->userDoingTheFollowing->username}}
        </a>
        @endforeach
      </div>
</x-profile>