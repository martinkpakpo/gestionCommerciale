



   		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="{{ asset('HTML_version/js/plugin/pace/pace.min.js') }}"></script>

		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->


	

		<!-- IMPORTANT: APP CONFIG -->
		<script src="{{ asset('HTML_version/js/app.config.js') }}"></script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
		<script src="{{ asset('HTML_version/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js') }}"></script> 

		<!-- BOOTSTRAP JS -->
		<script src="{{ asset('HTML_version/js/bootstrap/bootstrap.min.js') }}"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="{{ asset('HTML_version/js/notification/SmartNotification.min.js') }}"></script>

		<!-- JARVIS WIDGETS -->
		<script src="{{ asset('HTML_version/js/smartwidgets/jarvis.widget.min.js') }}"></script>

		<!-- EASY PIE CHARTS -->
		<script src="{{ asset('HTML_version/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js') }}"></script>

		<!-- SPARKLINES -->
		<script src="{{ asset('HTML_version/js/plugin/sparkline/jquery.sparkline.min.js') }}"></script>

		<!-- JQUERY VALIDATE -->
		<script src="{{ asset('HTML_version/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>

		<!-- JQUERY MASKED INPUT -->
		<script src="{{ asset('HTML_version/js/plugin/masked-input/jquery.maskedinput.min.js') }}"></script>

		<!-- JQUERY SELECT2 INPUT -->
		<script src="{{ asset('HTML_version/js/plugin/select2/select2.min.js') }}"></script>

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="{{ asset('HTML_version/js/plugin/bootstrap-slider/bootstrap-slider.min.js') }}"></script>

		<!-- browser msie issue fix -->
		<script src="{{ asset('HTML_version/js/plugin/msie-fix/jquery.mb.browser.min.js') }}"></script>

		<!-- FastClick: For mobile devices -->
		<script src="{{ asset('HTML_version/js/plugin/fastclick/fastclick.min.js') }}"></script>

		<!--[if IE 8]>

		<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

		<![endif]-->

		<!-- Demo purpose only -->

		<!-- MAIN APP JS FILE -->
		<script src="{{ asset('HTML_version/js/app.min.js') }}"></script>
      <script src="{{ asset('alert/alert/js/alert.js') }}"></script>

		<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
		<!-- Voice command : plugin -->
		<script src="{{ asset('HTML_version/js/speech/voicecommand.min.js') }}"></script>

		<!-- SmartChat UI : plugin -->
		<script src="{{ asset('HTML_version/js/smart-chat-ui/smart.chat.ui.min.js') }}"></script>
		<script src="{{ asset('HTML_version/js/smart-chat-ui/smart.chat.manager.min.js') }}"></script>
		<script src="{{ asset('HTML_version/js/plugin/datatables/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('HTML_version/js/plugin/datatables/dataTables.colVis.min.js') }}"></script>
		<script src="{{ asset('HTML_version/js/plugin/datatables/dataTables.tableTools.min.js') }}"></script>
		<script src="{{ asset('HTML_version/js/plugin/datatables/dataTables.bootstrap.min.js') }}"></script>
		<script src="{{ asset('HTML_version/js/plugin/datatable-responsive/datatables.responsive.min.js') }}"></script>
		<!-- PAGE RELATED PLUGIN(S) 
		<script src="..."></script>-->

		<script type="text/javascript">

			$(document).ready(function() {
			 	
				/* DO NOT REMOVE : GLOBAL FUNCTIONS!
				 *
				 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
				 *
				 * // activate tooltips
				 * $("[rel=tooltip]").tooltip();
				 *
				 * // activate popovers
				 * $("[rel=popover]").popover();
				 *
				 * // activate popovers with hover states
				 * $("[rel=popover-hover]").popover({ trigger: "hover" });
				 *
				 * // activate inline charts
				 * runAllCharts();
				 *
				 * // setup widgets
				 * setup_widgets_desktop();
				 *
				 * // run form elements
				 * runAllForms();
				 *
				 ********************************
				 *
				 * pageSetUp() is needed whenever you load a page.
				 * It initializes and checks for all basic elements of the page
				 * and makes rendering easier.
				 *
				 */
				
				 pageSetUp();
				 
				/*
				 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
				 * eg alert("my home function");
				 * 
				 * var pagefunction = function() {
				 *   ...
				 * }
				 * loadScript("{{ asset('HTML_version/js/plugin/_PLUGIN_NAME_.js') }}", pagefunction);
				 * 
				 * TO LOAD A SCRIPT:
				 * var pagefunction = function (){ 
				 *  loadScript(".../plugin.js') }}", run_after_loaded);	
				 * }
				 * 
				 * OR
				 * 
				 * loadScript(".../plugin.js') }}", run_after_loaded);
				 */

             			/* BASIC ;*/
				var responsiveHelper_dt_basic = undefined;
				var responsiveHelper_datatable_fixed_column = undefined;
				var responsiveHelper_datatable_col_reorder = undefined;
				var responsiveHelper_datatable_tabletools = undefined;
				
				var breakpointDefinition = {
					tablet : 1024,
					phone : 480
				};
	
				$('#dt_basic').dataTable({
					"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
					"autoWidth" : true,
					"preDrawCallback" : function() {
						// Initialize the responsive datatables helper once.
						if (!responsiveHelper_dt_basic) {
							responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
						}
					},
					"rowCallback" : function(nRow) {
						responsiveHelper_dt_basic.createExpandIcon(nRow);
					},
					"drawCallback" : function(oSettings) {
						responsiveHelper_dt_basic.respond();
					}
				});




				$('.mypersonnaldata').dataTable();
	
			/* END BASIC */
				
			})
		
		</script>
 <script type="text/javascript">
 function page_redirect(url){  
window.location = url;  
}  
   // To make Pace works on Ajax calls
   $(document).ajaxStart(function() { Pace.restart(); });
   function loadPage_(url_) {
      document.getElementById("loadingMessage").style.display = "none";

      $.ajax({url: '#', success: function(result){
           $('.ajax-content').load(url_);
       }});
   }
</script>

@if ($errors->any())
<script type="text/javascript">
    $.alert.open({
        type: 'error',
        title: 'Saisie invalide',
        draggable: false,
        content: '@foreach ($errors->all() as $error) {{$error}}<br /> @endforeach'
    });
</script>
@endif

@if(Session::has('success'))
<script type="text/javascript">
   $.alert.open({
          type: 'success',
          title: 'Enregistrement réussi',
          draggable: false,

          content: "{{Session::get('success')}}"
      });
</script>
@endif
<script type="text/javascript">
	setTimeout(function() {
	   document.getElementById("loadingMessage").style.display = "none";
	   document.getElementById("pagecorp").style.display = "block";
		}, 2000);
	</script>
@if(Session::has('error'))
<script type="text/javascript">
  $.alert.open({
         type: 'error',
         title: 'Saisie invalide',
         draggable: false,
         content: "{{Session::get('error')}}"
     });
</script>
@endif

<script>
	function NewTab(url) {
            window.open(url,"", "width=900, height=1000");
        }
	function LogoutFunc() {
			event.preventDefault();
    		$.alert.open(
    			'Voulez-vous vraiment déconnecter ?',
				{
					A: 'Oui',
					C: 'Non'
				},
					function(button) {
						if (button=="A")
						document.getElementById('logout-form').submit();
						else
							$.alert.open('Déconnexion annulée');
					}
				);
                                        
	}

	function deleteFromCart(urlCode) {
			event.preventDefault();
    		$.alert.open(
    			'Voulez-vous supprimer cette ligne ?',
				{
					A: 'Oui',
					C: 'Non'
				},
					function(button) {
						if (button=="A")
							window.location.href = "{{asset('/Cart/delete')}}/"+urlCode;
						else
							$.alert.open('Suppression annulée');
					}
				);
                                        
	}

	function deleteFromCartVente(urlCode) {
			event.preventDefault();
    		$.alert.open(
    			'Voulez-vous supprimer cette ligne ?',
				{
					A: 'Oui',
					C: 'Non'
				},
					function(button) {
						if (button=="A")
							window.location.href = "{{asset('/Cart/vente/delete')}}/"+urlCode;
						else
							$.alert.open('Suppression annulée');
					}
				);
                                        
	}
</script>