<script src="{{ asset('vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('vendor/jqvmap/js/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/deznav-init.js') }}"></script>
{{-- <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script> --}}
<script src="{{ asset('vendor/draggable/draggable.js') }}"></script>
<script src="{{ asset('vendor/swiper/js/swiper-bundle.min.js') }}"></script>

<script src="{{ asset('vendor/global/global.min.js') }}"></script>
<script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('vendor/apexchart/apexchart.js') }}"></script>
<script src="{{ asset('vendor/lightgallery/js/lightgallery-all.min.js') }}"></script>

<script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>
<script src="{{ asset('vendor/draggable/draggable.js') }}"></script>
<script src="{{ asset('vendor/swiper/js/swiper-bundle.min.js') }}"></script>

<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"
    integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script> --}}

<script src="{{ asset('vendor/tagify/dist/tagify.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{-- <script src="https://player.vimeo.com/api/player.js"></script> --}}
<!-- SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://vjs.zencdn.net/7.16.0/video.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"
    integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

{{-- <script src="vendor/jqvmap/js/jquery.vmap.min.js"></script>
<script src="vendor/jqvmap/js/jquery.vmap.world.js"></script>
<script src="vendor/jqvmap/js/jquery.vmap.usa.js"></script>







{{-- <script src="vendor/global/global.min.js"></script>
<script src="vendor/chart.js/Chart.bundle.min.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="vendor/apexchart/apexchart.js"></script> --}}


{{-- <script src="js/dashboard/dashboard-1.js"></script>
<script src="vendor/draggable/draggable.js"></script>
<script src="vendor/swiper/js/swiper-bundle.min.js"></script> --}}


<!-- tagify -->
{{-- <script src="vendor/tagify/dist/tagify.js"></script>

<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/js/dataTables.buttons.min.js"></script>
<script src="vendor/datatables/js/buttons.html5.min.js"></script>
<script src="vendor/datatables/js/jszip.min.js"></script>
<script src="js/plugins-init/datatables.init.js"></script> --}}

<!-- Apex Chart -->
{{--
<script src="vendor/bootstrap-datetimepicker/js/moment.js"></script>
<script src="vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script> --}}


<!-- Vectormap -->
{{-- <script src="vendor/jqvmap/js/jquery.vmap.min.js"></script>
<script src="vendor/jqvmap/js/jquery.vmap.world.js"></script>
<script src="vendor/jqvmap/js/jquery.vmap.usa.js"></script>
<script src="js/custom.js"></script>
<script src="js/deznav-init.js"></script>
<script src="js/demo.js"></script>
<script src="js/styleSwitcher.js"></script> --}}
<script>
    jQuery(document).ready(function() {
        // setTimeout(function(){
        dzSettingsOptions.version = 'dark';
        new dzSettings(dzSettingsOptions);
        // },100)
    });
</script>

<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;
            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;
            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;
            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
    @endif
</script>

<script>
    $(document).ready(function() {
        var dropdown = $('.searchDropdown');

        dropdown.hide();

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.searchDropdown').length) {
                dropdown.hide();
            }
        });

        $('#searchInput').on('input', function() {
            var searchTerm = $(this).val();

            $.ajax({
                url: "{{ route('search') }}",
                method: 'GET',
                data: {
                    term: searchTerm,
                },
                success: function(data) {
                    displayResults(data);
                }
            });
        });

        function displayResults(results) {
            dropdown.empty();

            if (results.length > 0) {
                for (var i = 0; i < Math.min(results.length, 5); i++) {
                    var result = results[i];
                    var text, id, link;

                    text = result.name;
                    id = result.id;
                    if (result.video_type === 'reels') {
                        link = "{{ url('/dashboard') }}/" + id;
                    } else if (result.video_type === 'podcasts') {
                        link = "{{ url('/podcast') }}/" + id;
                    }

                    var linkElement = $('<a>').attr('href', link).text(text).addClass('dropdown-item');
                    var listItem = $('<li>').append(linkElement);
                    dropdown.append(listItem);

                    dropdown.show();
                }
            } else {
                var noResultsItem = $('<li>').addClass('no-result').text('No results found');
                dropdown.append(noResultsItem);

                dropdown.show();
            }
        }

    });
</script>

<script>
    $(document).ready(function() {

        function checkNotifications() {

            var hasNotifications = $('.notify-div').find('a').length > 0;

            $(".noti-dot").hide();

            if (hasNotifications) {
                $(".noti-dot").show();
            }
        }

        getNotifications();

        function getNotifications() {
            $.ajax({
                url: "{{ route('get.notifications') }}",
                method: 'GET',
                dataType: 'json',
                data: {
                    '_token': "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.notification.length > 0) {
                        if (response.status === 'user') {
                            let notificationHTML = '';
                            response.notification.forEach(value => {
                                if (value.type ===
                                    'App\\Notifications\\VideoAssignedNotification') {
                                    let notify_message = '';
                                    if (value.data.title === 'New Video Assigned') {
                                        notify_message = value.data.name;
                                    }
                                    notificationHTML += `
                                    <a style="display: flex;" href="javascript:void(0)" class="text-reset notification-item pt-2 border-bottom" id="${value.id}" data-url="${value.data.url}">
                                        <div class="media-body">
                                            <h6 class="mb-1">${value.data.title}</h6>
                                            <h6 class="mb-1 noti-font"><span class="noti-color">Title: </span>${value.data.video_title}</h6>
                                            <h6 class="mb-1 noti-font"><span class="noti-color">Deadline: </span>${value.data.deadline}</h6>
                                        </div>
                                    </a>`;
                                }
                            });
                            $('.notify-div').html(notificationHTML);
                        } else if (response.status === 'owner') {
                            let notificationHTML = '';
                            response.notification.forEach(value => {
                                if (value.type ===
                                    'App\\Notifications\\VideoAssignedNotification') {
                                    let notify_message = '';
                                    let data = JSON.parse(value.data);
                                    let status = (value.read_at === null) ? 'Unread' :
                                        'Read';
                                    notificationHTML += `
                                <a style="display: flex;" class="text-reset pt-2 border-bottom">
                                    <div class="media-body">
                                        <h6 class="mb-1">Assigned Video</h6>
                                        <h6 class="mb-1 noti-font"><span class="noti-color">Name: </span>${data.name}</h6>
                                        <h6 class="mb-1 noti-font"><span class="noti-color">Title: </span>${data.video_title}</h6>
                                        <h6 class="mb-1 noti-font"><span class="noti-color">Deadline: </span>${data.deadline}</h6>
                                        <h6 class="mb-1 noti-font"><span class="noti-color">Status: </span>${status}</h6>
                                    </div>
                                </a>`;
                                }
                            });
                            $('.notify-div').html(notificationHTML);
                        }
                    } else {
                        $('.notify-div').html('<p class="no-noti">No notifications available</p>');
                    }
                    // checkReadNotifications();
                },
                complete: function() {
                    console.log('complete');
                    checkNotifications();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        $(document).on('click', '.notification-item', function() {
            let id = $(this).attr('id');
            let url = $(this).data('url');

            $.ajax({
                url: "{{ route('marked.read', ['id' => ':id']) }}".replace(':id', id),
                method: 'GET',
                dataType: 'json',
                data: {
                    '_token': "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response) {
                        window.location.href = "{{ url('') }}/" + url;
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

    });
</script>
