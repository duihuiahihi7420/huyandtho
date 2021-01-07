
<div class="pagination">
    <footer>
        <center>
           <?php 
            // PHẦN HIỂN THỊ PHÂN TRANG
            // BƯỚC 7: HIỂN THỊ PHÂN TRANG
 
            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            if ($page > 1 && $numberPage > 1){
                echo '<a href="?page='.($page-1).'"> Prev </a> | ';
            }
 
            // Lặp khoảng giữa
            for ($i = 1; $i <= $numberPage; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $page){
                    echo '<span>'.$i.'</span> | ';
                }
                else{
                    echo '<a href="?page='.$i.'">'.$i.'</a> | ';
                }
            }
 
            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($page < $numberPage && $numberPage > 1){
                echo '<a href="?page='.($page+1).'"> Next </a> | ';
            }
           ?>
           </center>
    </footer>
          
</div>

<style>

footer {
    display : block;
}
.pagination {
    border: 1px solid grey;
    position: absolute;
    top: 99%;
    left: 70%;
}
    
</style>