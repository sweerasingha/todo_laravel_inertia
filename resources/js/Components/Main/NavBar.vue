<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <Link class="navbar-brand" href="/">Navbar</Link>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <Link href="/todo" class="nav-link active" aria-current="page">Todo List</Link>
                        </li>
                        <li class="nav-item">
                            <Link href="#" class="nav-link">Link</Link>
                        </li>
                        <!-- Dropdown items can remain as <a> tags since they typically handle JS actions or no navigation -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <span>
                        <Link href="/logout" class="btn btn-outline-danger">Logout</Link>
                    </span>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
    components: {
        Link
    }
}
</script>
