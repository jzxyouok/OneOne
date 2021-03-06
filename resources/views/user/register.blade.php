@extends('layouts.login')

@section('content')
<div class="sbox">
	<div class="sbox-title">
			
				<h3 >{{ CNF_APPNAME }}</h3>
				
	</div>
	<div class="sbox-content">
	<div class="text-center  animated fadeInDown delayp1">
		<img src="{{ asset('static/images/logo-sximo.png')}}" width="70" height="70" />
	</div>		
 {!! Form::open(array('url'=>'user/create', 'class'=>'form-signup')) !!}
	    	@if(Session::has('message'))
				{!! Session::get('message') !!}
			@endif
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	
	<div class="form-group has-feedback">
		<label>{{ Lang::get('core.username') }}	 </label>
	  {!! Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'用户名' ,'required'=>'' )) !!}
		<i class="icon-users form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label>{{ Lang::get('core.email') }}	 </label>
	 {!! Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'例: root@mofei.org','required'=>'email')) !!}
		<i class="icon-envelop form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label>{{ Lang::get('core.password') }}	</label>
	 {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'密码','required'=>'')) !!}
		<i class="icon-lock form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label>{{ Lang::get('core.repassword') }}	</label>
	 {!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'确认密码','required'=>'')) !!}
		<i class="icon-lock form-control-feedback"></i>
	</div>
    @if(CNF_RECAPTCHA =='true') 
    <div class="form-group has-feedback  animated fadeInLeft delayp1">
        <label class="text-left"> 验证码</label>
        <br />
        {!! captcha_img() !!} <br /><br />
        <input type="text" name="captcha" placeholder="输入验证码" class="form-control" required/>

        <div class="clr"></div>
    </div>
    @endif						

      <div class="row form-actions">
        <div class="col-sm-12">
          <button type="submit" style="width:100%;" class="btn btn-primary pull-right"><i class="icon-user-plus"></i> {{ Lang::get('core.signup') }}	</button>
       </div>
      </div>
	  <p style="padding:10px 0" class="text-center">
	  <a href="{{ URL::to('user/login')}}"> {{ Lang::get('core.signin') }}  </a> | <a href="{{ URL::to('')}}"> {{ Lang::get('core.backtosite') }}  </a> 
   		</p>
 {!! Form::close() !!}
 </div>
</div> 
@stop
