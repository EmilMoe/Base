<template>
    <span>
        <ui-button
                v-if="label"
                :label="label"
                tooltip="Fjern"
                size="small"
                color="red"
                :icon="icon"
                @click="show()"
                type="secondary">
            {{ label }}
        </ui-button>
        <ui-icon-button
                v-else
                :icon="icon === null ? 'close' : icon"
                tooltip="Fjern"
                size="small"
                @click="show()"
                type="secondary">
        </ui-icon-button>
        <ui-confirm
                confirm-button-text="Accepter"
                deny-button-text="Annuller"
                ref="confirm"
                :title="title"
                type="danger"
                @confirm="confirmed"
                @deny="cancel">
            <slot></slot>
            <template v-if="! $slots.default">
                Er du sikker på, at du fortsætte?
            </template>
        </ui-confirm>
    </span>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: 'Er du sikker på, at du vil fortsætte'
        },
        value: {
            type: Object,
            required: true
        },
        label: {
            type: String,
            default: null
        },
        icon: {
            type: String,
            default: null
        }
    },
    methods: {
        show() {
            this.$refs.confirm.open()
        },
        confirmed() {
            this.$emit('confirmed', this.value)
        },
        cancel() {
            this.$refs.confirm.close()
        }
    }
}
</script>