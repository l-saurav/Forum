<x-modal-confirm
    event-to-open-modal="custom-show-delete-modal"
    event-to-close-modal="discussionWasDeleted"
    modal-title="Delete Discussion"
    modal-description="Are you sure you want to delete this discussion? This action cannot be undone."
    modal-confirm-button-text="Delete"
    wire-click="deleteDiscussion"
/>