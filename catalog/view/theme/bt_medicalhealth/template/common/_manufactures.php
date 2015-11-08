<div class="box category">
    <div class="box-heading">Manufactures</div>
    <div class="box-content">
        <div class="box-category">
            <ul>
                <?php
                foreach ($manufactures as $manuf) {
                    ?>
                    <li>
                        <input type="checkbox" class="manu_manuf" id="manuf_<?php echo $manuf['manufacturer_id']; ?>" value="<?php echo $manuf['manufacturer_id']; ?>" />
                        <a href="?route=product/category/&manuf=<?php echo $manuf['manufacturer_id']; ?>"><?php echo $manuf['name']; ?></a>
                    </li>

                    <?php
                }
                ?>
                <li>
                    <input onclick='reload_page()' 
                           type="checkbox" class="" value="All" />
                    All
                </li
            </ul>
        </div>
    </div>
</div>