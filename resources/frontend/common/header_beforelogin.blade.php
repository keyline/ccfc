<div class="" id="collapsemember-login">
                                            <div class="member-login">
                                                <div class="member-title hideonmobile">
                                                    Member Login
                                                </div>
                                                <!-- <form> -->
                                                <form action="{{ route('member.check') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <!-- <input type="text" class="form-control" placeholder="User Name" autocomplete="off"> -->
                                                        <input id="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            placeholder="Member Code" name="email"
                                                            value="{{ old('email', null) }}">
                                                        
                                                        @if($errors->has('email'))
                                                        <div class="invalid-feedback">
                                                           {{ $errors->first('email') }}
                                                        </div>
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="form-group">
                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password"
                                                            placeholder="{{ trans('global.login_password') }}">

                                                        <!-- <input type="password" class="form-control" placeholder="Password" readonly onfocus="this.removeAttribute('readonly')" onblur="this.setAttribute('readonly')"> -->
                                                        <!--<input type="password" readonly onfocus="this.removeAttribute('readonly')" onblur="this.setAttribute('readonly')">-->
                                                        
                                                        @if($errors->has('password'))
                                                        <div class="invalid-feedback">
                                                           {{ $errors->first('password') }}
                                                        </div>
                                                        @endif
                                                        
                                                        

                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <button type="submit" class="login-btn">login
                                                                <!-- {{ __('Log in') }} -->
                                                            </button>
                                                            <!-- <button type="submit" class="login-btn">login</button> -->
                                                        </div>
                                                        <div class="form-group col-md-8">
                                                            <a href="#" class="forgot">Forgot Password?</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>