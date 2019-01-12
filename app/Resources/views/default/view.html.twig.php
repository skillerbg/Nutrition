{% extends 'base.html.twig' %}

{% block body %}
<div class="container body-content span=8 offset=2">
    <div class="well">
        <form class="form-horizontal" >

        <fieldset>


                  <font size="50">
                        <center>
                        <b > {{entity.name}}
                        </b>
                        </center>
                    </font>


            <div class="form-group">
                <label class="col-sm-4 control-label" for="article_content">Type:</label>
                <div class="col-sm-6">
                    {{entity.type}}

                </div>
            </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="article_content">Description:</label>
                    <div class="col-sm-6">
                        {{entity.description}}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="article_price">Price</label>
                    <div class="col-sm-4 ">
                        {{entity.price|number_format(2, '.', ',')}}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="quantity">Grams:</label>
                    <div class="col-sm-6">
                        {{entity.quantity|number_format(2, '.', ',')}}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="picture">Picture URL:</label>
                    <div class="col-sm-4 ">
                        {{entity.picture}}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="kcal">Kcal per 100g:</label>
                    <div class="col-sm-6">
                        {{entity.kcal|number_format(1, '.', ',')}}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="fats">Fats per 100g:</label>
                    <div class="col-sm-4 ">
                        {{entity.fats|number_format(1, '.', ',')}}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="ufats">Unsaturated fats  per 100g:</label>
                    <div class="col-sm-6">
                        {{entity.unSaturatedFats|number_format(1, '.', ',')}}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="sfats">Saturated fats  per 100g:</label>
                    <div class="col-sm-4 ">
                        {{entity.saturatedFats|number_format(1, '.', ',')}}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="protein">Proteins per 100g:</label>
                    <div class="col-sm-6">
                        {{entity.proteins|number_format(1, '.', ',')}}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="carbs">Carbs per 100g:</label>
                    <div class="col-sm-4 ">
                        {{entity.carbs|number_format(1, '.', ',')}}

                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-4 control-label" for="sugars">Suagars per 100g:</label>
                    <div class="col-sm-4 ">
                        {{entity.sugars|number_format(1, '.', ',')}}

                    </div>
                </div>




            </fieldset>
    </div>
</div>

{% endblock %}
