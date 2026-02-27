@props(['url', 'title', 'description', 'image' => null, 'type' => 'post'])

<div class="social-sharing-component">
    <div class="flex flex-wrap gap-2">
        <!-- Facebook -->
        <a href="#" 
           onclick="shareToSocial('facebook', '{{ $url }}', '{{ addslashes($title) }}', '{{ addslashes($description ?? '') }}', '{{ $image ?? '' }}'); return false;"
           class="flex items-center px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm"
           title="Share on Facebook">
            <i class="fab fa-facebook-f mr-2"></i>
            <span>Facebook</span>
        </a>
        
        <!-- Twitter/X -->
        <a href="#" 
           onclick="shareToSocial('twitter', '{{ $url }}', '{{ addslashes($title) }}', '{{ addslashes($description ?? '') }}', '{{ $image ?? '' }}'); return false;"
           class="flex items-center px-3 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors text-sm"
           title="Share on Twitter">
            <i class="fab fa-twitter mr-2"></i>
            <span>Twitter</span>
        </a>
        
        <!-- LinkedIn -->
        <a href="#" 
           onclick="shareToSocial('linkedin', '{{ $url }}', '{{ addslashes($title) }}', '{{ addslashes($description ?? '') }}', '{{ $image ?? '' }}'); return false;"
           class="flex items-center px-3 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors text-sm"
           title="Share on LinkedIn">
            <i class="fab fa-linkedin-in mr-2"></i>
            <span>LinkedIn</span>
        </a>
        
        <!-- WhatsApp -->
        <a href="#" 
           onclick="shareToSocial('whatsapp', '{{ $url }}', '{{ addslashes($title) }}', '{{ addslashes($description ?? '') }}', '{{ $image ?? '' }}'); return false;"
           class="flex items-center px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors text-sm"
           title="Share on WhatsApp">
            <i class="fab fa-whatsapp mr-2"></i>
            <span>WhatsApp</span>
        </a>
        
        <!-- Telegram -->
        <a href="#" 
           onclick="shareToSocial('telegram', '{{ $url }}', '{{ addslashes($title) }}', '{{ addslashes($description ?? '') }}', '{{ $image ?? '' }}'); return false;"
           class="flex items-center px-3 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition-colors text-sm"
           title="Share on Telegram">
            <i class="fab fa-telegram mr-2"></i>
            <span>Telegram</span>
        </a>
        
        <!-- Email -->
        <a href="mailto:?subject={{ urlencode($title) }}&body={{ urlencode($description . ' ' . $url) }}" 
           class="flex items-center px-3 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors text-sm"
           title="Share via Email">
            <i class="fas fa-envelope mr-2"></i>
            <span>Email</span>
        </a>
        
        <!-- Copy Link -->
        <a href="#" 
           onclick="copyToClipboard('{{ $url }}'); return false;"
           class="flex items-center px-3 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors text-sm"
           title="Copy link to clipboard">
            <i class="fas fa-link mr-2"></i>
            <span>Copy Link</span>
        </a>
    </div>
</div>

<script>
function shareToSocial(platform, url, title, description, image) {
    const encodedUrl = encodeURIComponent(url);
    const encodedTitle = encodeURIComponent(title);
    
    let shareUrl = '';
    
    switch(platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodedTitle}`;
            break;
        case 'linkedin':
            shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`;
            break;
        case 'whatsapp':
            shareUrl = `https://wa.me/?text=${encodedTitle}%20${encodedUrl}`;
            break;
        case 'telegram':
            shareUrl = `https://t.me/share/url?url=${encodedUrl}&text=${encodedTitle}`;
            break;
        default:
            return false;
    }
    
    // Open in popup window for better user experience
    const popupWidth = 600;
    const popupHeight = 400;
    const left = (screen.width - popupWidth) / 2;
    const top = (screen.height - popupHeight) / 2;
    
    window.open(
        shareUrl,
        'social-share',
        `width=${popupWidth},height=${popupHeight},left=${left},top=${top},resizable=yes,scrollbars=yes`
    );
    
    return false;
}

function copyToClipboard(text) {
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(() => {
            showCopyNotification('Link copied to clipboard!');
        }).catch(() => {
            fallbackCopyTextToClipboard(text);
        });
    } else {
        fallbackCopyTextToClipboard(text);
    }
    
    return false;
}

function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.position = "fixed";
    textArea.style.left = "-999999px";
    textArea.style.top = "-999999px";
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        document.execCommand('copy');
        showCopyNotification('Link copied to clipboard!');
    } catch (err) {
        console.error('Fallback: Oops, unable to copy', err);
        // Show prompt as last resort
        prompt('Copy to clipboard: Ctrl+C, Enter', text);
    }
    
    document.body.removeChild(textArea);
}

function showCopyNotification(message) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
    notification.textContent = message;
    notification.style.transition = 'opacity 0.3s ease-in-out';
    
    document.body.appendChild(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Enhanced Web Share API support
function shareNative(title, text, url, image) {
    if (navigator.share) {
        const shareData = {
            title: title,
            text: text,
            url: url
        };
        
        // Add image if available and supported
        if (image && navigator.canShare && navigator.canShare({files: [new File([], 'image.jpg')]})) {
            shareData.files = [image];
        }
        
        navigator.share(shareData)
            .then(() => console.log('Shared successfully'))
            .catch((error) => console.log('Error sharing:', error));
    } else {
        // Fallback to traditional sharing
        showCopyNotification('Native sharing not available. Use the buttons above.');
    }
}
</script>