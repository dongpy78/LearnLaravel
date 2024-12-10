<x-profile :sharedData="$sharedData" doctitle="Who {{ $sharedData['username'] }} Follows">
  <div class="list-group">
    @foreach ($following as $follow)
      <a href="/post/{{ $follow->userBeingFollowed->username }}" class="list-group-item list-group-item-action">
        <img style="width: 32px; height: 32px; border-radius: 16px" class="avatar-tiny" src="{{$follow->userBeingFollowed->avatar}}" />
        {{$follow->userBeingFollowed->username}}        
      </a>
    @endforeach               
  </div>
</x-profile>


