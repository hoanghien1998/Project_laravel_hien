<div class="row formSearch" style="display: none">
    <div class="col-md-8">
        <div class="jumbotron">
            <span id="showErrorSearch"></span>
            <form action="/action_page.php" method="post" id="searchFrm">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12"><label>Keyword:</label></div>
                        <div class="col-md-12"><input type="text" class="form-control" id="keyword" name="keyword">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12"><label>Year:</label></div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="startYear" name="startYear">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="endYear" name="endYear">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12"><label>Price</label></div>
                    <div class="col-md-12">
                        <select class="form-control" name="price">
                            <option value="2000-10000">2000 - 10000</option>
                            <option value="10000-200000">10000 - 200000</option>
                            <option value="200000-300000">200000 - 300000</option>
                            <option value="morethan300000">More than 300000</option>
                        </select>
                    </div>
                </div>
                <div class="row text-center" style="margin-top: 5px">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row" id="ResultSearch">
</div>
