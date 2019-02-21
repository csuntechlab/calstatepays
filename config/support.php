<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Email recipient addresses
    |--------------------------------------------------------------------------
    |
    | The various addresses to use as recipients for the emails. Multiple
    | addresses can be specified if separated with a pipe character.
    |
    | Ex: info@example.com|help@example.com|feedback@example.com
    |
    */
    'recipients' => [

        'feedback' => env("FEEDBACK_RECIPIENT"),

        'support' => env("SUPPORT_RECIPIENT"),

    ],

    /*
    |--------------------------------------------------------------------------
    | Email senders
    |--------------------------------------------------------------------------
    |
    | The various addresses and display names to use as senders for the
    | feedback and support messages.
    |
    | The "From" value will be determined by the MAIL_FROM env value outside
    | of this package if the FEEDBACK_FROM_ADDR or SUPPORT_FROM_ADDR values do
    | not exist. If there is still no valid address, an exception will be
    | thrown.
    |
    */
    'senders' => [

        'feedback' => [

            'address' => env("FEEDBACK_FROM_ADDR", env("MAIL_FROM")),

            'name' => env("FEEDBACK_FROM_NAME", "Do Not Reply"),

        ],

        'support' => [

            'address' => env("SUPPORT_FROM_ADDR", env("MAIL_FROM")),

            'name' => env("SUPPORT_FROM_NAME", "Do Not Reply"),

        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Email titles
    |--------------------------------------------------------------------------
    |
    | The titles to use for the various emails that will be sent.
    |
    */
    'titles' => [

        'feedback' => env("FEEDBACK_TITLE", "New Feedback Submission"),

        'support' => env("SUPPORT_TITLE", "New Support Request"),

    ],

    /*
    |--------------------------------------------------------------------------
    | Submitter (User model) metadata
    |--------------------------------------------------------------------------
    |
    | The properties of the configured User model that will be used when adding
    | information to the feedback and support emails. The following are the
    | default attribute names to work with Laravel's default User model:
    |
    | Submitter ID (primary key): "id"
    | Submitter display name attribute: "name"
    | Submitter email attribute: "email"
    |
    */
    'submitter' => [

        'id' => env("SUBMITTER_ID_ATTR", "id"),

        'name' => env("SUBMITTER_NAME_ATTR", "name"),

        'email' => env("SUBMITTER_EMAIL_ATTR", "email"),

    ],

    /*
    |--------------------------------------------------------------------------
    | Allow override of application name?
    |--------------------------------------------------------------------------
    |
    | Determines whether the name of the application reported in the message
    | can be overridden by a request input value with the name of
    | "application_name". If this is set to true, it can promote the creation
    | of a central support request system that allows the user to pick the
    | application where the issue arose, for example.
    |
    | Default value is false.
    |
    */
    'allow_application_name_override' => env("ALLOW_APPLICATION_NAME_OVERRIDE", false),

    /*
    |--------------------------------------------------------------------------
    | Should submitter be CC'd?
    |--------------------------------------------------------------------------
    |
    | Determines whether the user submitting the form(s) should also be CC'd
    | by default. Default value is false.
    |
    */
    'send_copy_to_submitter' => env("SEND_COPY_TO_SUBMITTER", false),

    /*
    |--------------------------------------------------------------------------
    | Email message types
    |--------------------------------------------------------------------------
    |
    | Determines the type (either "text" or "html") to use for the email
    | messages. You will want to set this value to match the way your email
    | views are structured.
    |
    */
    'types' => [

        'feedback' => env("FEEDBACK_TYPE", "text"),

        'support' => env("SUPPORT_TYPE", "text"),

    ],

    /*
    |--------------------------------------------------------------------------
    | Support Impact Selections
    |--------------------------------------------------------------------------
    |
    | The values that will populate the "impact" drop-down field on the support
    | form view.
    |
    */
    'impact' => serialize(
        [
            'high' => 'High - Unable to work',
            'medium' => 'Medium - Can work, difficult workaround',
            'low' => 'Low - Minor issue',
        ]
    ),

    /*
    |--------------------------------------------------------------------------
    | Database support (optional)
    |--------------------------------------------------------------------------
    |
    | Database support is enabled by default so you will need to have a valid
    | database connection. This can be changed with the ENABLE_DB environment
    | value.
    |
    | The database tables where the feedback and support submissions will be
    | stored is determined by the published models. The migrations must be run
    | prior to any database queries.
    |
    | The full namespace to the published models can also be modified here in
    | the "models" array within this element. An exception will be thrown if
    | the specified model cannot be found during its usage in the controllers.
    |
    */
    'database' => [

        'enabled' => env("SUPPORT_ENABLE_DB", true),

        'models' => [

            'feedback' => 'CSUNMetaLab\Support\Models\FeedbackSubmission',

            'support' => 'CSUNMetaLab\Support\Models\SupportSubmission',

        ],

    ],

];