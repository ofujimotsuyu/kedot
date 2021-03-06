@extends('layouts.app')

@section('content')


 <div class="container">
    <div class="row">
        <div class="">
            <p class="groupitiran">グループ一覧</p>
                <div class="papabox">
                	<a class="Abutton" href="#popup1">How to use kedot</a>
                </div>
            
               <div class="groupscss">
                   <ul class="groups nav nav-pills nav-justified">
                       <li class ="col-xs-6 mygroupsss"><a href="{{ route('groups.mygroups', ['id' => \Auth::user()->id] ) }}">my group</a></li>
                        <li class = "col-xs-6 allgrouppp"><a href="{{ route('groups.index',['id' => \Auth::user()->id]) }}">all group</a></li>
                   </ul>
               </div>
           
          <!--指定したuser_id、かつstatusが２参加中のやつをもってくる-->
              <div class = "groups">
              @foreach($groups as $group)
                  <div class = "each_group">
                  <a href="{{ route('groups.show', ['id' => $group->id]) }}"><img src="{{url($group->group_filename)}}" alt="avatar"/><p>{{ $group->goal }}</p></a>
                  </div>
              @endforeach
              </div>
       </div>
    </div> 
</div>

<div id="popup1" class="overlay" style="z-index: 8000">
	<div class="popup">
		<div class="content">
    		<a class="close" href="#">CLOSE</a>
			@include('commons.explanation')
		</div>
	</div>
</div>
@endsection