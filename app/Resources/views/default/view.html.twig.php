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
                    <label class="col-sm-4 control-label" for="article_content">Ingredients:</label>
                    <div class="col-sm-6">
                        <table>
                        <tr>
                        <td> {% for elements in entity.array if elements!=0%}
                         {{ elements|nl2br }} grams - <br>
                        {% endfor %}
                        </td>


                        <td>
                        {% for raws in entity.raws%}

                            <a href="{{}}"> {{ raws.name|nl2br }}<br>}</a>

                        {% endfor %}

                        </td>
                        </tr>
                        </table>
                    </div>
                </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="article_price">Recipe:</label>
                <div class="col-sm-6 ">
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
                        {{nutrition.kcal|number_format(1, '.', ',')}}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="fats">Fats per 100g:</label>
                    <div class="col-sm-4 ">
                        {{nutrition.fats|number_format(1, '.', ',')}}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="ufats">Unsaturated fats  per 100g:</label>
                    <div class="col-sm-6">
                        {{nutrition.unSaturatedFats|number_format(1, '.', ',')}}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="sfats">Saturated fats  per 100g:</label>
                    <div class="col-sm-4 ">
                        {{nutrition.saturatedFats|number_format(1, '.', ',')}}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="protein">Proteins per 100g:</label>
                    <div class="col-sm-6">
                        {{nutrition.proteins|number_format(1, '.', ',')}}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="carbs">Carbs per 100g:</label>
                    <div class="col-sm-4 ">
                        {{nutrition.carbs|number_format(1, '.', ',')}}

                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-4 control-label" for="sugars">Suagars per 100g:</label>
                    <div class="col-sm-4 ">
                        {{nutrition.sugars|number_format(1, '.', ',')}}

                    </div>
                </div>




            </fieldset>
    </div>
</div>

{% endblock %}
