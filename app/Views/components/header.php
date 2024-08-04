<header class="flex h-fit md:h-24 md:gap-5 mb-12">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between h-full px-6">

        <!-- Logo Section -->
        <div class="flex items-center sm:w-full bg-primary text-tileBackground rounded-xl shadow-md p-4">
            <a href="#" class="text-2xl font-bold">E-Learning</a>
        </div>

        <!-- Navigation -->
        <nav class="flex sm:w-full text-tileBackground bg-primary shadow-smooth md:rounded-2xl gap-4 p-3">
            <a href="/" class="flex items-center text-lg py-2 px-4 rounded-lg menu-item" id="home">
                <i class="las la-home mr-2 text-xl"></i>
                <span>Home</span>
            </a>
            <?php if (session()->has('userid')) : ?>
            <a href="/course" class="flex items-center text-lg py-2 px-4 rounded-lg menu-item" id="course">
                <i class="las la-school mr-2 text-xl"></i>
                <span>Courses</span>
            </a>
            <?php endif; ?>
        </nav>

        <!-- User Section -->
        <?php if (!session()->has('userid')) { ?>
            <div class=" flex flex-row ">
                <a href="/auth" class="button-primary text-center">
                    <i class="las la-sign-in-alt text-xl"></i>
                    <span>Sign In</span>
                </a>
            </div>

        <?php } else { ?>
            <div class="flex items-center bg-tileBackground shadow-md p-2 rounded-lg">
                <div class="profile-photo w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center text-xl font-bold uppercase border-2 border-white" id="profilePhoto" data-name="<?= session()->get('userfullname') ?>"></div>
                <div class="ml-4">
                    <h1 class="text-gray-800 font-semibold"><?= session()->get('userfullname') ?></h1>
                    <span class="text-gray-600"><?= session()->get('userrole') ?></span>
                </div>
                <div class="ml-4 flex flex-row">
                    <a href="/logout" class="button-secondary text-center">
                        <i class="las la-sign-out-alt text-xl"></i>
                        <span>Sign Out</span>
                    </a>
                </div>
            </div>
        <?php } ?>

    </div>
</header>
