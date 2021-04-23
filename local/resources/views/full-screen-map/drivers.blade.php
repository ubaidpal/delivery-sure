{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 26-Jul-16 2:33 PM
    * File Name    : 

--}}
<div class="col-md-12">
    <div class="row">
        <div class="modal-map" style="height: 700px; width: 1140px; margin-top: 51px;" id="driver-map-full">

        </div>
    </div><!-- /.row -->
</div><!-- /.col-md-9 -->
{!! HTML::script('local/public/assets/pages/favourite.js') !!}
<script>

            var driverLocations = <?php echo json_encode($driverMarkers);?>;
    initMap('driver-map-full');
</script>
