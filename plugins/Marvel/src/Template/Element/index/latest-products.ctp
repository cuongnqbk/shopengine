<div class="container">
    <div class="row">
        <div class="col-md-9 main-content">
            <h3>Products</h3>

            <div class="row">
                <?php
                $count = 0;
                ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="item-overlay">
                            <div class="thumb-item-img">
                                <?= $this->Html->Link($this->Html->image($product->image_dir . explode(',', $product->image)[0], ['alt' => 'Product Image',
                                    'class' => 'img-responsive']), [
                                    'controller' => 'Products',
                                    'action' => 'view',
                                    $product->id
                                ], [
                                    'escape' => false
                                ]); ?>

                            </div>
                            <div class="thumb-item-content">
                                <h3><?php echo $this->Html->Link($product->title, ['action' => 'view', $product->id]); ?></h3>
                                <p class="product-price">
                                    <span><?= $currency_unit . " " . number_format((float)$product->price, 2) ?></span>
                                </p>
                                <button
                                    type="button"
                                    class="btn btn-success addToCart"
                                    data-id="<?= $product->id ?>"
                                    data-title="<?= $product->title ?>"
                                    data-price="<?= $product->price ?>"
                                    data-src="<?= $product->image_dir . $product->image ?>"
                                >Add to Cart
                                </button>
                            </div>

                        </div>
                    </div>
                    <?php
                    $count++;
                    if ($count == 3) {
                        break;
                    }
                endforeach;
                ?>
            </div>

            <script>
                $(document).ready(function () {
                    $('.addToCart').click(function () {
                        var id = $(this).data("id");
                        var title = $(this).data("title");
                        var price = $(this).data("price");
                        var src = $(this).data("src");
                        var product = id + ',' + title + ',' + price + ',' + src;


                        $.ajax({
                            type: "POST",
                            data: {data: product},
                            url: "<?/*= Cake\Routing\Router::url(["prefix" => false, "controller" => "Products", "action" => "addToCart"]);*/?>",
                            success: function (data, textStatus, jqXHR) {
                                $('#cartPrice').html(parseInt($('#cartPrice').html(), 10) + price);
                                $('#cartCount').html(parseInt($('#cartCount').html(), 10) + 1);
                            },
                            error: function (data, textStatus, jqXHR) {
                                alert("Error: " + data + " status: " + textStatus + " jqXHR: " + jqXHR);
                            }
                        });

                    });
                });
            </script>
        </div>
