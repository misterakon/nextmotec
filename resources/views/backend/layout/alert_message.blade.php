<script type="text/javascript">

	// Affichage des messages d'erreur et succès

	@if ($errors->any())
		Swal.fire({
			// title: 'Warning!',
			text: '{{ $errors->first() }}',
			icon: 'warning',
			customClass: {
			confirmButton: 'btn btn-primary waves-effect waves-light'
			},
			buttonsStyling: false
		});
	@endif

	@if(session('error'))
		Swal.fire({
			// title: 'Warning!',
			text: '{{ session("error") }}',
			icon: 'warning',
			customClass: {
			confirmButton: 'btn btn-primary waves-effect waves-light'
			},
			buttonsStyling: false
		});
    @endif

	@if(session('info'))
		Swal.fire({
			// title: 'Info!',
			text: '{{ session("info") }}',
			icon: 'info',
			customClass: {
			confirmButton: 'btn btn-primary waves-effect waves-light'
			},
			buttonsStyling: false
		});
    @endif

	@if(session('success'))
		Swal.fire({
			// title: 'Good job!',
			text: '{{ session("success") }}',
			icon: 'success',
			customClass: {
				confirmButton: 'btn btn-primary waves-effect waves-light'
			},
			buttonsStyling: false
		});
    @endif
			
</script>



