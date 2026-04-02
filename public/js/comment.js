function cmtreply(comm_id, parentId, parentType) {
    const container = document.getElementById(`reply-${comm_id}`);
    const config = window.commentConfig;

    container.innerHTML = `
        <form method="POST" action="${config.route}">
            <input type="hidden" name="_token" value="${config.csrf}">
            
            <input type="hidden" name="commentable_id" value="${parentId}">
            <input type="hidden" name="commentable_type" value="${parentType}">
            <input type="hidden" name="parent_id" value="${comm_id}">
            
            <input type="text" name="content" placeholder="Reply as ${config.username}..." required>
            <button type="submit">Send</button>
        </form>
    `;
}