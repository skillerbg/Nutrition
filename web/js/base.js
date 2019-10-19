var $j = jQuery.noConflict();
var productNames = [];

$j(document).ready(function(){

    $j('.search').each(function() {
        $j(this).typeahead({

            source: function(query, result)
            {
                $j.ajax({
                    url: '{{ path('recipe_search') }}',
                    method:"POST",
                    data:{query:query},
                    dataType:"json",
                    success:function(data)
                    {
                        result($j.map(data, function(item){
                            var productNames = [];

                            $j.each(item, function(index, product) {
                                productNames.push(product.name + "#" + product.picture + "#" + product.id + "#" + product.price + "#" + product.pricePerG);
                            });
                            return productNames;
                        }));

                    }
                })
            },

            highlighter: function(item) {
                console.log(item);
                var parts = item.split('#'),
                    html = '<div><div class="typeahead-inner" id="' + parts[2] + '">';
                html += '<img src="' + parts[1] + '" width="50" height="50" alt="ingredient img">';
                html += '<div class="item-body">';
                html += '<p class="item-heading">' + parts[0] + '</p>';
                html += '<p class="item-heading">Price:' + parts[3] + '&emsp; Price per G:' + Math.round(parts[4] * 100) / 100 + '</p>';
                html += '<p><a href="http://127.0.0.1:8000/raw/view?id='+parts[2]+'">View</a></p>';

                html += '</div>';
                html += '</div><hr></div>';



                return html;
            } , afterSelect: function (item) {
                console.log(item);
                console.log('afterSelect: ' + item.id);
                $j('.hiddenid').val(item.id); }
            ,
            updater: function(item) {
                var parts = item.split('#');
                window.location.assign("http://127.0.0.1:8000/recipe/view/"+parts[2]) ;

                return item={name:parts[0], id:parts[2]};

            }



        }); });})