@section('js')

<script src="{{ asset('assets/vendors/scripts/core.js') }}"></script>
<script src="{{ asset('assets/vendors/scripts/script.min.js') }}"></script>
<script src="{{ asset('assets/vendors/scripts/process.js') }}"></script>
<script src="{{ asset('assets/vendors/scripts/layout-settings.js') }}"></script>
{{-- <script src="{{ asset('assets/src/plugins/apexcharts/apexcharts.min.js') }}"></script> --}}
<script src="{{ asset('assets/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
{{-- <script src="{{ asset('assets/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script> --}}
<script src="{{ asset('assets/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendors/scripts/dashboard.js') }}"></script>
<script src="{{ asset('assets/src/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
{{-- <script src="{{ asset('assets/vendors/scripts/calendar-setting.js') }}"></script> --}}
<!-- Datatable Setting js -->
<script src="{{ asset('assets/vendors/scripts/datatable-setting.js') }}"></script>

<script>
    $(document).ready(function (){
        $('.deleteData').click(function (e) {
            e.preventDefault();

            var data_id = $(this).val();
            $('#data_id').val(data_id);
            $('#deletemodal').modal('show');
        });

        $('.tolakData').click(function (e) {
            e.preventDefault();

            var id = $(this).val();
            $('#idtolak').val(id);
            $('#tolakmodal').modal('show');
        });
    });

jQuery(document).ready(function () {
	jQuery("#add-event").submit(function () {
		alert("Submitted");
		var values = {};
		$.each($("#add-event").serializeArray(), function (i, field) {
			values[field.name] = field.value;
		});
		console.log(values);
	});
});

(function () {
	"use strict";
	// ------------------------------------------------------- //
	// Calendar
	// ------------------------------------------------------ //
	jQuery(function () {
		// page is ready
		jQuery("#calendar").fullCalendar({
			themeSystem: "bootstrap4",
			// emphasizes business hours
			businessHours: false,
			defaultView: "month",
			// event dragging & resizing
			editable: true,
			// header
			header: {
				left: "title",
				right: "today prev,next",
			},
			events: [
                @if (Auth::user()->role->title=='Mahasiswa' || Auth::user()->role->title=='Dosen')
                    @foreach ($calendar as $value)
                        {
                            title: "{{ $value->name.' - Pukul : '.$value->waktu.' - '.date('d M Y', strtotime($value->tanggal)) }}",
                            description:
                                "{{ $value->keterangan }}",
                            start: "{{ $value->tanggal }}",
                            end: "{{ $value->tanggal }}",
                            className: "fc-bg-default",
                            icon: "calendar",
                        },
                    @endforeach
                @endif
                @if (Auth::user()->role->title=='Mahasiswa')
                    @foreach ($deadline as $value)
                        {
                            title: "{{ $value->name.' - DEADLINE TUGAS - '.date('d M Y', strtotime($value->deadline)) }}",
                            description:
                                "{{ $value->judul }}",
                            start: "{{ $value->deadline }}",
                            end: "{{ $value->deadline }}",
                            className: "fc-bg-pinkred",
                            icon: "calendar",
                        },
                    @endforeach
                @endif
			],
			dayClick: function () {
				jQuery("#modal-view-event-add").modal();
			},
			eventClick: function (event, jsEvent, view) {
				jQuery(".event-icon").html("<i class='fa fa-" + event.icon + "'></i>");
				jQuery(".event-title").html(event.title);
				jQuery(".event-body").html(event.description);
				jQuery(".eventUrl").attr("href", event.url);
				jQuery("#modal-view-event").modal();
			},
		});
	});
})(jQuery);

</script>

@endsection
