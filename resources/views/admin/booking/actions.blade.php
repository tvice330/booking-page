@isset($row->id)
    <div class="actions-row">
        <a href="{{ route('admin.booking.accept', $row->id) }}" onClick="return confirm('Are you sure to accept booking application?')" class="btn accept-btn">accept</a>
        <a href="{{ route('admin.booking.delete', $row->id) }}" onClick="return confirm('Are you sure to delete this booking application?')">
            <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.3388 2.87829H13.1776V2.19984C13.1776 0.986842 12.1908 0 10.9778 0H7.0222C5.8092 0 4.82236 0.986842 4.82236 2.19984V2.87829H0.661178C0.35279 2.87829 0.106079 3.125 0.106079 3.43339C0.106079 3.74178 0.35279 3.98849 0.661178 3.98849H1.66447V17.0313C1.66447 18.6678 2.9967 20 4.63322 20H13.3668C15.0033 20 16.3355 18.6678 16.3355 17.0313V3.98849H17.3388C17.6472 3.98849 17.8939 3.74178 17.8939 3.43339C17.8939 3.125 17.6472 2.87829 17.3388 2.87829ZM5.93256 2.19984C5.93256 1.59951 6.42187 1.1102 7.0222 1.1102H10.9778C11.5781 1.1102 12.0674 1.59951 12.0674 2.19984V2.87829H5.93256V2.19984ZM15.2253 17.0313C15.2253 18.0551 14.3906 18.8898 13.3668 18.8898H4.63322C3.60937 18.8898 2.77466 18.0551 2.77466 17.0313V3.98849H15.2294V17.0313H15.2253Z" fill="#AE8B70"/>
                <path d="M8.99992 16.8996C9.3083 16.8996 9.55501 16.6529 9.55501 16.3445V6.53368C9.55501 6.22529 9.3083 5.97858 8.99992 5.97858C8.69153 5.97858 8.44482 6.22529 8.44482 6.53368V16.3404C8.44482 16.6488 8.69153 16.8996 8.99992 16.8996Z" fill="#AE8B70"/>
                <path d="M5.37749 16.287C5.68587 16.287 5.93258 16.0403 5.93258 15.7319V7.14226C5.93258 6.83387 5.68587 6.58716 5.37749 6.58716C5.0691 6.58716 4.82239 6.83387 4.82239 7.14226V15.7319C4.82239 16.0403 5.07321 16.287 5.37749 16.287Z" fill="#AE8B70"/>
                <path d="M12.6225 16.287C12.9309 16.287 13.1776 16.0403 13.1776 15.7319V7.14226C13.1776 6.83387 12.9309 6.58716 12.6225 6.58716C12.3141 6.58716 12.0674 6.83387 12.0674 7.14226V15.7319C12.0674 16.0403 12.3141 16.287 12.6225 16.287Z" fill="#AE8B70"/>
            </svg>
        </a>
    </div>
@endisset
