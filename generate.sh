#!/bin/bash

# actions
WRITE_ACTION="write"
MODIFY_ACTION="modify"
REMOVE_ACTION="remove"

# model
NAMESPACE="Acme\Cars"
MODEL="Acme\Cars\Car"

# model attributes - skip id parameter
ATTRIBUTES="name,code"

# events to generate
EVENTS=( EventName1 EventName2 EventName3 )

#
# execute
#

# commands
php artisan generate:command:write "$NAMESPACE" "$MODEL" "$ATTRIBUTES" "$WRITE_ACTION"
php artisan generate:command:modify "$NAMESPACE" "$MODEL" "$ATTRIBUTES" "$MODIFY_ACTION"
php artisan generate:command:remove "$NAMESPACE" "$MODEL" "$ATTRIBUTES" "$REMOVE_ACTION"

# events
for EVENT in "${EVENTS[@]}"
do
    php artisan generate:event "$NAMESPACE" "$MODEL" "$EVENT"
done

#validators
php artisan generate:validator:write "$NAMESPACE" "$MODEL" "$ATTRIBUTES" "$WRITE_ACTION"
php artisan generate:validator:modify "$NAMESPACE" "$MODEL" "$ATTRIBUTES" "$MODIFY_ACTION"
php artisan generate:validator:remove "$NAMESPACE" "$MODEL" "$ATTRIBUTES" "$REMOVE_ACTION"

#handlers
php artisan generate:handler:write "$NAMESPACE" "$MODEL" "$ATTRIBUTES" "$WRITE_ACTION"
php artisan generate:handler:modify "$NAMESPACE" "$MODEL" "$ATTRIBUTES" "$MODIFY_ACTION"
php artisan generate:handler:remove "$NAMESPACE" "$MODEL" "$ATTRIBUTES" "$REMOVE_ACTION"
