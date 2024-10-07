<script>
    document.addEventListener("DOMContentLoaded", function() {
        var openModalButtons = document.querySelectorAll('.note-img');
        openModalButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var targetId = this.getAttribute('data-target');
                var noteSection = document.getElementById(targetId);
                var imageWrapper = this.closest('.image-wrapper');
                if (noteSection.style.display === 'none') {
                    noteSection.style.display = 'block';
                    imageWrapper.style.backgroundColor = '#FCF8C7';
                } else {
                    noteSection.style.display = 'none';
                    imageWrapper.style.backgroundColor = 'none';
                    imageWrapper.style.background = 'none';

                }
            });
        });
    });

    $(function() {
        $('.note-textarea').on('keyup', function() {
            var noteId = $(this).data('note-id');
            // console.log(noteId);
            var noteContent = $(this).val();
            // console.log(noteContent);
            saveNoteToDatabase(noteId, noteContent);
        });

        function saveNoteToDatabase(noteId, noteContent) {
            const payload = {
                '_token': "{{ csrf_token() }}",
                'noteId': noteId,
                'noteContent': noteContent
            }
            $.ajax({
                url: "{{ route('save.student.notes') }}",
                method: 'POST',
                data: payload,
                success: function(response) {
                    // console.log('Note saved successfully.');
                },
                error: function(xhr, status, error) {
                    console.error('Error saving note:', error);
                }
            });
        }
    });

    $(document).ready(function() {

        $('.note-section').each(function() {
            var noteId = $(this).attr('id').split('_')[1];
            populateNoteTextarea(noteId);
        });

        function populateNoteTextarea(noteId) {
            $.ajax({
                url: "{{ route('get.student.notes') }}",
                type: 'GET',
                data: {
                    noteId: noteId
                },
                success: function(response) {
                    if (response.noteContent) {
                        $('#note_' + noteId + ' .note-textarea').val(response.noteContent);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching note content:', error);
                }
            });
        }

    });
</script>
