# ρ

Yet another PHP Microframework.

The premise of this framework is to be backwards-compatible (PHP <= 5.6) with powerful utilities (Like caching and
logging) and sensible defaults.

## Routes

Unlike other PHP frameworks, which have you define routes using classes and controllers, ρ has a more intuitive
approach, using files and directories to create routes:

```
routes
├─ $name.php
└─ index.php
```

Your route directory is your root (`/`), `index.php` would match requests to `/` or `/index`. Routes starting with a `$`
are parameterized routes, basically serving as a fallback route, with access to the path that was requested. You can
create nested parameterized routes (For multiple parameters) by separating parameters with a `.`:

```
routes
└─ $forumId.$postId.php
```

A request to `/foo/bar` will fall back to `$forumId.$postId.php` and you'll get access to both parameters as `forumId`
and `postId` respectfully.