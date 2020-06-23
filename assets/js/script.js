const flashData = $('.flash-data').data('flashdata');

// ? flashdata confirm
if (flashData) {
	Swal.fire({
		title: '<div style="color:#fff">Success</div>',
		html: '<div style="color:#fff">' + flashData + '</div>',
		icon: 'success',
		background: '#152e4d'
	});
}

// ? delete confirm
$('.btn-delete').on('click', function (e) {

	// ? disable href action
	e.preventDefault();

	// ? set variable and fill in variable condition when click one of the button delete
	const href = $(this).attr('href');

	Swal.fire({
		title: '<div style="color:#fff">Are You Sure ?</div>',
		html: '<div style="color:#fff">Data Will Be Deleted</div>',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: 'transparent',
		confirmButtonText: 'Yes, delete it!',
		cancelButtonText: '<b class="text-muted">Cancel</b>',
		reverseButtons: true,
		background: '#152e4d',
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});

});
