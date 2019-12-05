
	<div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky;">
	    <nav class="uk-navbar-container" uk-navbar style="position: relative; z-index: 980;">
	        <div class="uk-navbar-left">
	            <ul class="uk-navbar-nav">
	                <li class="uk-active">
	                	<a href="<?php echo base_url() ?>cn/student">
			            	<span class="uk-icon uk-margin-small-right">
			            		<img src="<?php echo base_url(); ?>assets/image/logo.png" style="width: 50px">
			            	</span>
			            	Ilaw
	                	</a>
	                </li>
	            </ul>
	        </div>

	        <div class="uk-navbar-right">
	            <ul class="uk-navbar-nav">
	                <li>
	                    <a href="#">
	                		<span class="uk-icon uk-margin-small-right" uk-icon="icon: settings"></span>Manage
	                    </a>
	                    <div class="uk-navbar-dropdown">
	                        <ul class="uk-nav uk-navbar-dropdown-nav">
	                            <li><a href="#card-class">
			                			<span class="uk-icon uk-margin-small-right" uk-icon="icon: users"></span>Class
	                        		</a>
	                        	</li>
	                        	<hr>
	                            <li><a href="#card-record">
			                			<span class="uk-icon uk-margin-small-right" uk-icon="icon: file-text"></span>Records
	                        		</a>
	                        	</li>
	                        </ul>
	                    </div>
	                </li>
	                <li>
	                    <a href="#">
	                		<span class="uk-icon uk-margin-small-right" uk-icon="icon: cog"></span>Settings
	                    </a>
	                    <div class="uk-navbar-dropdown">
	                        <ul class="uk-nav uk-navbar-dropdown-nav">
	                            <li>
	                            	<a href="<?php base_url(); ?>logout">
			                			<span class="uk-icon uk-margin-small-right" uk-icon="icon: sign-out"></span>Logout
	                            	</a>
	                            </li>
	                        </ul>
	                    </div>
	                </li>
	            </ul>
	        </div>
	    </nav>
	</div>