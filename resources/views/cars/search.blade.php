<div class="row formSearch" style="display: none">
    <div class="col-md-8">
        <div class="jumbotron">
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
                        <div class="col-md-6"><input type="text" class="form-control" id="startYear" name="startYear">
                        </div>
                        <div class="col-md-6"><input type="text" class="form-control" id="endYear" name="endYear"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12"><label>Price</label></div>
                    <div class="col-md-12">
                        <select class="form-control" name="price">
                            <option value="50000-100000">50000 - 100000</option>
                            <option value="100000-200000">100000 - 200000</option>
                            <option value="200000-300000">200000 - 300000</option>
                            <option value="morethan300000">More than 300</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>
