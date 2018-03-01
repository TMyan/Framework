<div class="row">
    <div class="col-md-6">
        <h1>Registration</h1>
        <form method="post" action="/user/signup">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" class="form-control" id="login" placeholder="Lohin">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" id="email" placeholder="Email">
            </div>
            <button type="submit" class="btn btn-default">Registration</button>
        </form>
    </div>
</div>