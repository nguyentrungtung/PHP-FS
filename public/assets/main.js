$(document).ready(function() {
    $(document).on('click', '.close-edit', function (event) {
        $('.modal-edit').removeClass('show');
    });
    
    
    function viewDetailStudent(event) {
        event.preventDefault();
        // Lấy giá trị của thuộc tính 'studentId' từ phần tử kích hoạt sự kiện
        var studentId = $(this).attr('studentId');
    
        // Lấy URL từ thuộc tính 'href' của phần tử kích hoạt sự kiện
        var url = $(this).attr('href');
    
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                _token: '{{ csrf_token() }}',
                studentId: studentId, // Gửi studentId cùng với dữ liệu
            },
            dataType: 'json',
            success: function (response) {
                var student = response.student;
    
                $('.modal-edit .card-body').html(`
                    <p><strong>Tên:</strong> ${student.name}</p>
                    <p><strong>Tuổi:</strong> ${student.age}</p>
                    <img src="/build_fw/public/${student.photo}" alt="Ảnh sinh viên" style="max-width: 500px; height: auto;">
                `);
                // Hiển thị modal
                $('.modal-edit').addClass('show');
            },
        });
    }
    
    // Gán sự kiện click cho các phần tử có class 'modal_detail-student'
    $(document).on('click', '.modal_detail-student', viewDetailStudent);
});

