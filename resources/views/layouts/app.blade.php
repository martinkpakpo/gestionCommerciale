<!DOCTYPE html>
<html lang="fr-fr">
	<head>
		@include('layouts.css')
	</head>
    <body class="fixed-header fixed-navigation">
		@include('layouts.navbar')
		@include('layouts.sidebar')
		<div id="main" role="main">
			@include('layouts.title')
			<div id="content">
				<section id="widget-grid" class="">
					<div class="row">
						<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="jarviswidget" id="wid-id-0" data-widget-collapsed="false" data-widget-sortable="false" data-widget-custombutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false">
                                <header>
                                    <span class="widget-icon"> <i class="fa fa-folder-o"></i> </span>
                                    <h2>Fenètre principale </h2>				
                                </header>
								<div>
									<!-- widget edit box -->
									<div class="jarviswidget-editbox">
										<input class="form-control" type="text">	
									</div>
                                    <div class="widget-body">
                                        <div class="row" id="loadingMessage">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-4">
                                                <div class="text-center" >
                                                    <img src="{{ asset('kOnzy.gif') }}" alt="this slowpoke moves"  width="125" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4"></div>
                                        </div>
                                        <div class="ajax-content" style="display: none;" id="pagecorp">
                                            @yield('content')
                                        </div>
									</div>
                                </div>
                            </div>
                        </article>
                    </div>
                </section>
            </div>
        </div>
		@include('layouts.footer')
        @include('layouts.shortcut')
        @include('layouts.js') 
	</body>

</html>