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




//Toast Mess
// $(document).on('click', '.btn-save', function (event) {
//     // event.preventdefault()
//     toast({
//       title: 'Thành công!',
//       message: 'Bạn đã tạo thành công.',
//       type: 'success',
//       duration: 2000,
//     });
//   });

//   function toast({
//     title = '',
//     message = '',
//     type = 'info',
//     duration = 3000
//   }) {

//     const main = document.getElementById('toast');
//     if (main) {
//       const toast = document.createElement('div');

//       // Auto remove toast
//       const autoRemoveId = setTimeout(function () {
//         main.removeChild(toast);
//       }, duration + 500);

//       // Remove toast when clicked
//       toast.onclick = function (e) {
//         if (e.target.closest('.toast__close')) {
//           main.removeChild(toast);
//           clearTimeout(autoRemoveId);
//         }
//       };

//       const icons = {
//         success: 'fas fa-check-circle',
//         info: 'fas fa-info-circle',
//         warning: 'fas fa-exclamation-circle',
//         error: 'fas fa-exclamation-circle',
//       };
//       const icon = icons[type];
//       const delay = (duration / 1000).toFixed(2);

//       toast.classList.add('toast', `toast--${type}`);
//       toast.style.animation = `slideInLeft ease .3s, fadeOut linear 1s ${delay}s forwards`;
//       toast.innerHTML = `
//               <div class="toast__icon">
//                   <i class="${icon}"></i>
//               </div>
//               <div class="toast__body">
//                   <h3 class="toast__title">${title}</h3>
//                   <p class="toast__msg">${message}</p>
//               </div>
//               <div class="toast__close">
//                   <i class="fas fa-times"></i>
//               </div>
//           `;
//       main.appendChild(toast);
//     }
//   }
