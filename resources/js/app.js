import './bootstrap';

if (window.userId) {
    console.log(`Subscribing to private channel: App.Models.User.${window.userId}`);
    window.Echo.private(`App.Models.User.${window.userId}`)
        .notification((notification) => {
            console.log('Notification received via .notification():', notification);
            let message = notification.message || notification.data?.message || JSON.stringify(notification);

            // Show Toast
            if (typeof showToast === 'function') {
                showToast(message, 'info');
            } else {
                alert(message);
            }

            // Update Badge
            const badge = document.getElementById('notification-badge');
            if (badge) {
                badge.style.display = 'block';
            } else {
                // Create badge if not exists
                const btn = document.querySelector('.relative.group button') || document.querySelector('.relative[x-data] button');
                if (btn) {
                    const newBadge = document.createElement('span');
                    newBadge.id = 'notification-badge';
                    newBadge.className = 'absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white animate-pulse';
                    btn.appendChild(newBadge);
                }
            }

            const list = document.getElementById('notification-list');
            if (list) {
                const emptyMsg = list.querySelector('.text-center');
                if (emptyMsg) emptyMsg.remove();

                const newNotif = document.createElement('div');
                newNotif.className = 'p-4 border-b border-slate-50 hover:bg-slate-50 transition-colors cursor-pointer relative group bg-indigo-50/30';
                newNotif.innerHTML = `
                    <p class="text-sm text-slate-600 leading-snug">${message}</p>
                    <p class="text-[10px] text-slate-400 font-bold mt-1">A l'instant</p>
                    <span class="absolute top-4 right-4 w-1.5 h-1.5 bg-indigo-500 rounded-full"></span>
                `;
                list.insertBefore(newNotif, list.firstChild);
            }
        })

} else {
    console.log('No user ID found, skipping Echo subscription.');
}
