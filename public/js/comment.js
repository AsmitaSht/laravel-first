function cmtreply(comm_id) {
    const container = document.getElementById(`reply-${comm_id}`);

    container.innerHTML = `
        <form method="POST" action="${window.commentConfig.route}">
            <input type="hidden" name="_token" value="${window.commentConfig.csrf}">
            <input type="hidden" name="commentable_id" value="${window.commentConfig.blogId}">
            <input type="hidden" name="commentable_type" value="${window.commentConfig.blogType}">
            <input type="hidden" name="parent_id" value="${comm_id}">
            <input type="text" name="content" placeholder="What's on your mind, ${window.commentConfig.username}" required>
            <button type="submit">Reply</button>
        </form>
    `;
}