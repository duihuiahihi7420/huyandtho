
    <div class="nagtion">
    <?php

    for($num = 1 ;$num < $numberPage;$num++){?>       
            <?php if($num !=$page) {?> 
                <?php if($num > $page-2 && $num < $page + 2 ) {?>    
                
                <div class= "css_page"> 
                        <a href="?per_page=3&page=<?= $num?>"> 
                        <span aria-hidden="true" ><?= $num?></span>
                        </a>  
                  
                </div>
            <?php
                }?>   
        
            <?php
            } else {?>
        
            <div class= "css_page">  
                <span aria-hidden="true"><?= $num ?></span>
                </div>
            <?php
        }?>     
    <?php
    }?>
</div>
    <style>
    /* .ca {
    padding:0px;
    } */
    .nagtion {
        position: fixed;
        top: 234px;
        right: 81px;
    }
    
    .css_page {
        border: solid 1px gray;
        width: 25px;
    }
    .css_page  {
        text-align: center;
        float: left;
    }
    </style>

