<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./layouts/head.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukie</title>
</head>

<body>
    <?php

    $booksAction = new Books();

    $benifits = [
        [
            "title" => "Lots of writings",
            "des" => "Here you’re able to find lots and lots of interesting books.",
            "rawSvg" => '<svg width="100" height="82" viewBox="0 0 100 82" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.25 12.175C11.7812 9.86249 19.7125 7.36874 27.425 6.59374C35.7375 5.75624 42.7875 6.98749 46.875 11.2937V72.2062C41.0312 68.8937 33.625 68.4375 26.7938 69.125C19.4188 69.875 11.9812 72.0062 6.25 74.1937V12.175ZM53.125 11.2937C57.2125 6.98749 64.2625 5.75624 72.575 6.59374C80.2875 7.36874 88.2188 9.86249 93.75 12.175V74.1937C88.0125 72.0062 80.5813 69.8687 73.2063 69.1312C66.3688 68.4375 58.9688 68.8875 53.125 72.2062V11.2937ZM50 5.64374C43.8438 0.349987 34.9188 -0.437513 26.7938 0.374987C17.3313 1.33124 7.78125 4.57499 1.83125 7.28124C1.28531 7.52954 0.822346 7.92969 0.497631 8.43394C0.172917 8.93819 0.000166071 9.52523 0 10.125L0 78.875C0.000144762 79.3979 0.131482 79.9123 0.381982 80.3713C0.632482 80.8302 0.994136 81.219 1.43382 81.502C1.8735 81.7849 2.37715 81.953 2.89865 81.9909C3.42014 82.0288 3.9428 81.9352 4.41875 81.7187C9.93125 79.2187 18.8125 76.2125 27.4188 75.3437C36.225 74.4562 43.6063 75.8875 47.5625 80.825C47.8553 81.19 48.2264 81.4845 48.6482 81.6869C49.0701 81.8893 49.5321 81.9944 50 81.9944C50.4679 81.9944 50.9299 81.8893 51.3518 81.6869C51.7736 81.4845 52.1447 81.19 52.4375 80.825C56.3938 75.8875 63.775 74.4562 72.575 75.3437C81.1875 76.2125 90.075 79.2187 95.5813 81.7187C96.0572 81.9352 96.5799 82.0288 97.1014 81.9909C97.6228 81.953 98.1265 81.7849 98.5662 81.502C99.0059 81.219 99.3675 80.8302 99.618 80.3713C99.8685 79.9123 99.9999 79.3979 100 78.875V10.125C99.9998 9.52523 99.8271 8.93819 99.5024 8.43394C99.1777 7.92969 98.7147 7.52954 98.1687 7.28124C92.2188 4.57499 82.6688 1.33124 73.2063 0.374987C65.0813 -0.443763 56.1562 0.349987 50 5.64374Z" fill="#A7ACB1"/>
        </svg>'
        ],
        [
            "title" => "In a while",
            "des" => "Quickly and painless access to anything at the website.",
            "rawSvg" => '<svg width="100" height="100" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_16_175)">
        <path d="M53.8854 6.86875C52.8143 6.78967 51.7407 6.75006 50.6667 6.75V0.5C51.895 0.500599 53.1229 0.546463 54.3479 0.6375L53.8854 6.86875ZM66.4104 9.68125C64.407 8.90809 62.3493 8.28348 60.2542 7.8125L61.6229 1.7125C64.0229 2.25 66.3687 2.9625 68.6604 3.85L66.4104 9.68125ZM74.9729 14.1187C74.0793 13.5228 73.1641 12.9599 72.2292 12.4313L75.3104 6.99375C77.4476 8.20412 79.4927 9.57031 81.4292 11.0813L77.5854 16.0125C76.7381 15.3515 75.8666 14.7219 74.9729 14.125V14.1187ZM86.4354 25.3063C85.199 23.55 83.8348 21.8872 82.3542 20.3313L86.8792 16.0188C88.5708 17.8062 90.1271 19.7021 91.5479 21.7062L86.4354 25.3063ZM91.0854 33.7563C90.6756 32.7652 90.2294 31.7895 89.7479 30.8313L95.3292 28.0187C96.4324 30.2133 97.3725 32.4861 98.1417 34.8188L92.2042 36.775C91.8684 35.7554 91.4952 34.7484 91.0854 33.7563ZM94.3979 49.425C94.3472 47.2771 94.1383 45.1359 93.7729 43.0187L99.9292 41.9562C100.346 44.3729 100.587 46.8104 100.654 49.2687L94.3979 49.425ZM93.5792 59.0375C93.7875 57.9792 93.9562 56.9167 94.0854 55.85L100.292 56.6188C99.9905 59.057 99.51 61.4698 98.8542 63.8375L92.8292 62.1687C93.1167 61.1396 93.3667 60.0958 93.5792 59.0375ZM87.6292 73.9062C88.7792 72.0896 89.7917 70.1979 90.6667 68.2312L96.3792 70.7625C95.3792 73.0125 94.2229 75.175 92.9104 77.25L87.6292 73.9062ZM81.6042 81.4375C82.3667 80.675 83.0958 79.8875 83.7917 79.075L88.5292 83.1562C87.7272 84.0867 86.8912 84.9873 86.0229 85.8562L81.6042 81.4375Z" fill="#A7ACB1"/>
        <path d="M50.6666 6.75C43.4721 6.75052 36.3888 8.52529 30.044 11.9171C23.6992 15.3089 18.2888 20.2131 14.292 26.1953C10.2952 32.1775 7.83536 39.053 7.13036 46.2129C6.42536 53.3728 7.49697 60.596 10.2503 67.2428C13.0035 73.8896 17.3535 79.7549 22.9149 84.3191C28.4763 88.8832 35.0775 92.0055 42.1337 93.4092C49.19 94.8129 56.4835 94.4548 63.3683 92.3666C70.2531 90.2784 76.5166 86.5245 81.6041 81.4375L86.0229 85.8562C80.2087 91.6736 73.0495 95.9671 65.1794 98.3562C57.3093 100.745 48.9715 101.156 40.9045 99.553C32.8376 97.9496 25.2908 94.3812 18.9326 89.1639C12.5744 83.9467 7.60124 77.2417 4.45374 69.6431C1.30623 62.0444 0.0815635 53.7867 0.888237 45.6017C1.69491 37.4166 4.50802 29.5569 9.07832 22.7189C13.6486 15.8809 19.835 10.2757 27.0893 6.40002C34.3436 2.52434 42.4419 0.49782 50.6666 0.500002V6.75Z" fill="#A7ACB1"/>
        <path d="M47.5417 19.25C48.3705 19.25 49.1653 19.5792 49.7514 20.1653C50.3374 20.7513 50.6667 21.5462 50.6667 22.375V54.9375L70.9667 66.5375C71.6654 66.959 72.1715 67.6371 72.3769 68.4268C72.5822 69.2165 72.4706 70.0553 72.0657 70.7637C71.6609 71.4722 70.995 71.9943 70.2103 72.2183C69.4257 72.4423 68.5845 72.3505 67.8667 71.9625L45.9917 59.4625C45.5134 59.1893 45.1158 58.7945 44.8392 58.3182C44.5626 57.8418 44.4168 57.3008 44.4167 56.75V22.375C44.4167 21.5462 44.7459 20.7513 45.3319 20.1653C45.918 19.5792 46.7129 19.25 47.5417 19.25Z" fill="#A7ACB1"/>
        </g>
        <defs>
        <clipPath id="clip0_16_175">
        <rect width="100" height="100" fill="white" transform="translate(0.666656 0.5)"/>
        </clipPath>
        </defs>
        </svg>'
        ],
        [
            "title" => "Get paid",
            "des" => "You can be awarded for your labors.",
            "rawSvg" => '<svg width="100" height="100" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M25.3334 67.8813C26.2584 78.3 34.7896 85.6938 47.7771 86.65V94.25H54.2959V86.65C68.4834 85.5312 77.2834 77.6625 77.2834 66.025C77.2834 56.0875 71.3646 50.3375 58.8084 47.1L54.2959 45.9313V22.1687C61.3084 22.8563 66.0396 26.6313 67.2334 32.2688H76.4209C75.3834 22.2688 66.7959 15.0938 54.2959 14.3V6.75H47.7771V14.4563C35.6584 15.8938 27.3396 23.6562 27.3396 34.1812C27.3396 43.2687 33.3771 49.7 43.9709 52.4125L47.7834 53.425V78.6187C40.6021 77.5562 35.6584 73.6188 34.4646 67.8813H25.3334ZM46.5271 43.9062C40.0084 42.2625 36.5271 38.75 36.5271 33.8062C36.5271 27.9062 40.9271 23.55 47.7771 22.3812V44.225L46.5271 43.9062ZM56.4709 55.6063C64.5146 57.625 68.0459 60.975 68.0459 66.6625C68.0459 73.5188 62.8834 78.0875 54.2959 78.7812V55.0625L56.4709 55.6063Z" fill="#A7ACB1"/>
        </svg>'
        ]
    ];
    $navigation = [
        [
            "title" => "My books",
            "des" => "Your local library with all books.",
            "rawSvg" => '<svg width="100" height="100" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4.5 0.62501H1.5C1.26794 0.62501 1.04538 0.717197 0.881282 0.881292C0.717187 1.04539 0.625 1.26795 0.625 1.50001V11.5C0.625 11.7321 0.717187 11.9546 0.881282 12.1187C1.04538 12.2828 1.26794 12.375 1.5 12.375H4.5C4.61491 12.375 4.72869 12.3524 4.83485 12.3084C4.94101 12.2644 5.03747 12.2 5.11872 12.1187C5.19997 12.0375 5.26442 11.941 5.30839 11.8349C5.35237 11.7287 5.375 11.6149 5.375 11.5V1.50001C5.375 1.3851 5.35237 1.27132 5.30839 1.16516C5.26442 1.059 5.19997 0.962543 5.11872 0.881292C5.03747 0.800041 4.94101 0.735588 4.83485 0.691616C4.72869 0.647643 4.61491 0.62501 4.5 0.62501ZM1.375 3.37501H4.625V9.62501H1.375V3.37501ZM1.5 1.37501H4.5C4.53315 1.37501 4.56495 1.38818 4.58839 1.41162C4.61183 1.43506 4.625 1.46686 4.625 1.50001V2.62501H1.375V1.50001C1.375 1.46686 1.38817 1.43506 1.41161 1.41162C1.43505 1.38818 1.46685 1.37501 1.5 1.37501ZM4.5 11.625H1.5C1.46685 11.625 1.43505 11.6118 1.41161 11.5884C1.38817 11.565 1.375 11.5332 1.375 11.5V10.375H4.625V11.5C4.625 11.5332 4.61183 11.565 4.58839 11.5884C4.56495 11.6118 4.53315 11.625 4.5 11.625ZM12.3562 10.6875L10.2819 0.82251C10.2585 0.709576 10.213 0.602385 10.148 0.507102C10.083 0.411818 9.9998 0.330322 9.90321 0.2673C9.80662 0.204279 9.69852 0.160976 9.58513 0.139882C9.47174 0.118787 9.3553 0.120318 9.2425 0.144385L6.31688 0.773135C6.09046 0.822905 5.89279 0.959948 5.76678 1.15453C5.64076 1.34911 5.59655 1.58554 5.64375 1.81251L7.71813 11.6756C7.74172 11.789 7.78757 11.8965 7.85301 11.992C7.91845 12.0874 8.00219 12.169 8.09937 12.2319C8.24003 12.3239 8.40442 12.373 8.5725 12.3731C8.63555 12.3734 8.69844 12.3667 8.76 12.3531L11.6856 11.725C11.9112 11.6747 12.1079 11.5377 12.2334 11.3436C12.3588 11.1495 12.403 10.9139 12.3562 10.6875ZM7.18062 5.48001L10.3512 4.79876L11.2338 8.99626L8.0625 9.67564L7.18062 5.48001ZM6.76625 3.50751L9.9375 2.82439L10.1969 4.06251L7.02625 4.74376L6.76625 3.50751ZM6.475 1.50751L9.4 0.879385C9.40873 0.878464 9.41752 0.878464 9.42625 0.879385C9.44962 0.87945 9.47244 0.886407 9.49187 0.899385C9.50623 0.908526 9.51857 0.920503 9.52814 0.934582C9.5377 0.948661 9.54429 0.964545 9.5475 0.98126L9.78187 2.09501L6.61187 2.77126L6.37813 1.66001C6.37082 1.62679 6.37689 1.59204 6.39502 1.56326C6.41315 1.53449 6.44189 1.51401 6.475 1.50626V1.50751ZM11.5256 10.995L8.6 11.625C8.58434 11.6285 8.56813 11.6288 8.55235 11.6259C8.53657 11.623 8.52153 11.6169 8.50813 11.6081C8.49377 11.599 8.48143 11.587 8.47186 11.5729C8.4623 11.5589 8.45571 11.543 8.4525 11.5263L8.21813 10.4125L11.3881 9.73126L11.625 10.8394C11.6287 10.8561 11.629 10.8733 11.626 10.8901C11.623 10.9069 11.6167 10.9229 11.6074 10.9373C11.5982 10.9516 11.5862 10.964 11.5722 10.9737C11.5581 10.9834 11.5423 10.9902 11.5256 10.9938V10.995Z" fill="#A7ACB1"/>
        </svg>'
        ],
        [
            "title" => "Find more",
            "des" => "Search engine for everything.",
            "rawSvg" => '<svg width="100" height="100" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.59002 8.79736C6.69133 9.51543 5.5518 9.86213 4.40547 9.76625C3.25914 9.67038 2.19303 9.13921 1.42611 8.28184C0.659181 7.42446 0.249659 6.30597 0.28165 5.15608C0.313641 4.0062 0.784716 2.9122 1.59812 2.0988C2.41153 1.28539 3.50552 0.814312 4.65541 0.782321C5.8053 0.75033 6.92379 1.15985 7.78117 1.92678C8.63854 2.6937 9.16971 3.75981 9.26558 4.90614C9.36146 6.05247 9.01476 7.192 8.29669 8.09069L11.734 11.5274C11.7831 11.5731 11.8225 11.6283 11.8499 11.6897C11.8772 11.751 11.8919 11.8172 11.8931 11.8843C11.8943 11.9515 11.8819 12.0182 11.8568 12.0804C11.8316 12.1427 11.7942 12.1992 11.7467 12.2467C11.6992 12.2942 11.6427 12.3316 11.5804 12.3568C11.5182 12.3819 11.4515 12.3943 11.3843 12.3931C11.3172 12.3919 11.251 12.3772 11.1897 12.3499C11.1283 12.3225 11.0731 12.2831 11.0274 12.234L7.59002 8.79736ZM2.30669 7.75602C1.81738 7.26667 1.48412 6.64324 1.34903 5.96454C1.21393 5.28583 1.28307 4.58231 1.54769 3.94289C1.81232 3.30347 2.26056 2.75684 2.83576 2.37209C3.41096 1.98734 4.08731 1.78175 4.77933 1.78128C5.47135 1.78081 6.14798 1.9855 6.7237 2.36948C7.29942 2.75345 7.74839 3.29947 8.01388 3.93854C8.27936 4.57761 8.34945 5.28103 8.21526 5.95992C8.08108 6.6388 7.74867 7.26268 7.26002 7.75269L7.25669 7.75602L7.25335 7.75869C6.59675 8.41377 5.70697 8.78144 4.77947 8.78094C3.85196 8.78044 2.96258 8.41181 2.30669 7.75602Z" fill="#A7ACB1"/>
        </svg>'
        ],
        [
            "title" => "Draft",
            "des" => "Write/edit/modify your own writing.",
            "rawSvg" => '<svg class="svg-secondary-standart" width="82" height="100" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M2.41957 22C1.85653 22 1.38679 21.8118 1.01035 21.4353C0.633902 21.0589 0.445273 20.5891 0.444458 20.0261V1.97389C0.444458 1.41167 0.633087 0.942333 1.01035 0.565889C1.38761 0.189444 1.85735 0.000814815 2.41957 0H12.0556L17.5556 5.5V20.0261C17.5556 20.5883 17.3673 21.0581 16.9909 21.4353C16.6145 21.8126 16.1443 22.0008 15.5805 22H2.41957ZM11.4445 6.11111V1.22222H2.41957C2.23135 1.22222 2.05861 1.30044 1.90135 1.45689C1.74409 1.61333 1.66587 1.78567 1.66668 1.97389V20.0261C1.66668 20.2135 1.7449 20.3859 1.90135 20.5431C2.05779 20.7004 2.23012 20.7786 2.41835 20.7778H15.5817C15.7691 20.7778 15.9414 20.6996 16.0987 20.5431C16.2559 20.3867 16.3342 20.2139 16.3333 20.0249V6.11111H11.4445Z" fill="#A7ACB1"/>
        </svg>'
        ]
    ];
    $localCharts = $booksAction->getAllBooks();
    $beginners = [
        [
            "name" => "Determined",
            "image" => "/assets/jpg/determined.jpg",
            "link" => "#",
            "isCost" => false
        ],
        [
            "name" => "Glitchtale",
            "image" => "https://ocdn.eu/zapytaj/MDA_/4f7972b9760a3f98e591b5064e161425.png",
            "link" => "#",
            "isCost" => false
        ],

    ];

    $fanCategories = [
        [
            "name" => "Books",
            "ico" => '<svg width="20" height="20" viewbox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.5 0.62501H1.5C1.26794 0.62501 1.04538 0.717197 0.881282 0.881292C0.717187 1.04539 0.625 1.26795 0.625 1.50001V11.5C0.625 11.7321 0.717187 11.9546 0.881282 12.1187C1.04538 12.2828 1.26794 12.375 1.5 12.375H4.5C4.61491 12.375 4.72869 12.3524 4.83485 12.3084C4.94101 12.2644 5.03747 12.2 5.11872 12.1187C5.19997 12.0375 5.26442 11.941 5.30839 11.8349C5.35237 11.7287 5.375 11.6149 5.375 11.5V1.50001C5.375 1.3851 5.35237 1.27132 5.30839 1.16516C5.26442 1.059 5.19997 0.962543 5.11872 0.881292C5.03747 0.800041 4.94101 0.735588 4.83485 0.691616C4.72869 0.647643 4.61491 0.62501 4.5 0.62501ZM1.375 3.37501H4.625V9.62501H1.375V3.37501ZM1.5 1.37501H4.5C4.53315 1.37501 4.56495 1.38818 4.58839 1.41162C4.61183 1.43506 4.625 1.46686 4.625 1.50001V2.62501H1.375V1.50001C1.375 1.46686 1.38817 1.43506 1.41161 1.41162C1.43505 1.38818 1.46685 1.37501 1.5 1.37501ZM4.5 11.625H1.5C1.46685 11.625 1.43505 11.6118 1.41161 11.5884C1.38817 11.565 1.375 11.5332 1.375 11.5V10.375H4.625V11.5C4.625 11.5332 4.61183 11.565 4.58839 11.5884C4.56495 11.6118 4.53315 11.625 4.5 11.625ZM12.3562 10.6875L10.2819 0.82251C10.2585 0.709576 10.213 0.602385 10.148 0.507102C10.083 0.411818 9.9998 0.330322 9.90321 0.2673C9.80662 0.204279 9.69852 0.160976 9.58513 0.139882C9.47174 0.118787 9.3553 0.120318 9.2425 0.144385L6.31688 0.773135C6.09046 0.822905 5.89279 0.959948 5.76678 1.15453C5.64076 1.34911 5.59655 1.58554 5.64375 1.81251L7.71813 11.6756C7.74172 11.789 7.78757 11.8965 7.85301 11.992C7.91845 12.0874 8.00219 12.169 8.09937 12.2319C8.24003 12.3239 8.40442 12.373 8.5725 12.3731C8.63555 12.3734 8.69844 12.3667 8.76 12.3531L11.6856 11.725C11.9112 11.6747 12.1079 11.5377 12.2334 11.3436C12.3588 11.1495 12.403 10.9139 12.3562 10.6875ZM7.18062 5.48001L10.3512 4.79876L11.2338 8.99626L8.0625 9.67564L7.18062 5.48001ZM6.76625 3.50751L9.9375 2.82439L10.1969 4.06251L7.02625 4.74376L6.76625 3.50751ZM6.475 1.50751L9.4 0.879385C9.40873 0.878464 9.41752 0.878464 9.42625 0.879385C9.44962 0.87945 9.47244 0.886407 9.49187 0.899385C9.50623 0.908526 9.51857 0.920503 9.52814 0.934582C9.5377 0.948661 9.54429 0.964545 9.5475 0.98126L9.78187 2.09501L6.61187 2.77126L6.37813 1.66001C6.37082 1.62679 6.37689 1.59204 6.39502 1.56326C6.41315 1.53449 6.44189 1.51401 6.475 1.50626V1.50751ZM11.5256 10.995L8.6 11.625C8.58434 11.6285 8.56813 11.6288 8.55235 11.6259C8.53657 11.623 8.52153 11.6169 8.50813 11.6081C8.49377 11.599 8.48143 11.587 8.47186 11.5729C8.4623 11.5589 8.45571 11.543 8.4525 11.5263L8.21813 10.4125L11.3881 9.73126L11.625 10.8394C11.6287 10.8561 11.629 10.8733 11.626 10.8901C11.623 10.9069 11.6167 10.9229 11.6074 10.9373C11.5982 10.9516 11.5862 10.964 11.5722 10.9737C11.5581 10.9834 11.5423 10.9902 11.5256 10.9938V10.995Z" fill="#0D6EFD"/>
        </svg>',
            "link" => "/category/books",
            "elements" => [
                [
                    "name" => "Harry Potter",
                    "link" => "/category/books/1"
                ],
                [
                    "name" => "1984, Animal Farm",
                    "link" => "/category/books/2"
                ],
                [
                    "name" => "Fahrenheit 451",
                    "link" => "/category/books/1"
                ],
                [
                    "name" => "The Witcher",
                    "link" => "/category/books/1"
                ],

            ]
        ],
        [
            "name" => "Mangas",
            "ico" => '<svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.0925 9.99692C16.657 9.33026 16.0646 8.78067 15.3672 8.3964C14.6698 8.01212 13.8887 7.80491 13.0925 7.79294C13.0805 7.4483 13.0367 7.10551 12.9615 6.76895C12.9345 6.63789 12.8814 6.51359 12.8054 6.40342C12.7295 6.29325 12.6322 6.19944 12.5193 6.12756C12.4064 6.05568 12.2803 6.00719 12.1483 5.98495C12.0163 5.96272 11.8812 5.9672 11.751 5.99812C11.6208 6.02905 11.4982 6.0858 11.3903 6.165C11.2824 6.2442 11.1916 6.34424 11.1231 6.4592C11.0546 6.57417 11.0099 6.70171 10.9916 6.83427C10.9733 6.96684 10.9817 7.10173 11.0165 7.23095C11.0609 7.42858 11.0884 7.62964 11.0985 7.83194C9.98302 7.97006 8.889 8.24617 7.84155 8.65394C7.86455 7.44995 7.91855 6.24696 8.03855 5.04697L8.07655 4.66497C9.24815 4.50504 10.4104 4.28306 11.5585 3.99998L11.6785 3.96998C11.8103 3.94274 11.9353 3.88918 12.0459 3.8125C12.1565 3.73582 12.2504 3.63761 12.3222 3.52374C12.3939 3.40988 12.4419 3.2827 12.4634 3.14984C12.4848 3.01697 12.4792 2.88115 12.4468 2.75051C12.4145 2.61987 12.3561 2.49709 12.2752 2.38954C12.1943 2.282 12.0926 2.19188 11.976 2.12461C11.8594 2.05733 11.7305 2.01427 11.5969 1.99802C11.4633 1.98176 11.3278 1.99264 11.1985 2.03L11.0765 2.06C10.1545 2.28999 9.22054 2.46399 8.28255 2.60999L8.43355 1.10001C8.46007 0.836117 8.38067 0.572502 8.21283 0.367151C8.12972 0.265472 8.0274 0.181158 7.91171 0.119023C7.79602 0.0568873 7.66922 0.0181477 7.53856 0.00501558C7.27467 -0.0215058 7.01105 0.0578879 6.8057 0.225731C6.60035 0.393575 6.47009 0.636119 6.44356 0.900007L6.24757 2.85999C5.31358 2.94299 4.37758 2.99999 3.43859 2.99999C3.17338 2.99999 2.91903 3.10534 2.73149 3.29288C2.54396 3.48041 2.4386 3.73476 2.4386 3.99998C2.4386 4.26519 2.54396 4.51954 2.73149 4.70708C2.91903 4.89461 3.17338 4.99997 3.43859 4.99997C4.30858 4.99997 5.17858 4.95397 6.04557 4.88597C5.89899 6.44755 5.83123 8.01552 5.84257 9.58393C5.70857 9.65693 5.57257 9.72593 5.43957 9.80392C4.75946 10.1935 4.10813 10.6313 3.49059 11.1139L3.46859 11.1319C2.46535 11.9055 1.57391 12.8141 0.819617 13.8319C0.469701 14.3159 0.271988 14.8932 0.251729 15.49C0.231471 16.0869 0.389587 16.6763 0.705882 17.1829C1.02218 17.6895 1.4823 18.0903 2.02747 18.3341C2.57264 18.578 3.17813 18.6538 3.76659 18.5518C4.75911 18.363 5.71622 18.0209 6.60356 17.5379C6.72707 17.732 6.91397 17.8773 7.13251 17.9493C7.35106 18.0212 7.58776 18.0152 7.80242 17.9324C8.01707 17.8496 8.19642 17.695 8.31002 17.4949C8.42361 17.2949 8.46443 17.0616 8.42555 16.8349C8.40055 16.6899 8.38955 16.5439 8.36755 16.3979C8.82946 16.041 9.26834 15.6552 9.68153 15.2429C10.4984 14.4288 11.2048 13.511 11.7825 12.5129C11.8055 12.4739 11.8245 12.4349 11.8475 12.3949C11.9655 12.1849 12.0775 11.9729 12.1795 11.7599C12.2325 11.6489 12.2815 11.5379 12.3305 11.4269C12.4522 11.1525 12.562 10.8729 12.6595 10.5889C12.6915 10.4929 12.7195 10.3979 12.7495 10.3019C12.7995 10.1329 12.8505 9.96492 12.8905 9.79793L12.8955 9.77992C13.3739 9.77305 13.847 9.8801 14.2758 10.0922C14.7046 10.3044 15.0767 10.6155 15.3615 10.9999C16.3805 12.7669 14.3985 15.9769 10.9445 18.1538C10.8334 18.2239 10.7372 18.3152 10.6614 18.4224C10.5856 18.5296 10.5316 18.6508 10.5026 18.7789C10.4736 18.907 10.4701 19.0395 10.4923 19.169C10.5145 19.2984 10.562 19.4222 10.632 19.5333C10.7021 19.6444 10.7933 19.7406 10.9006 19.8165C11.0078 19.8923 11.129 19.9463 11.257 19.9753C11.3851 20.0043 11.5177 20.0078 11.6472 19.9856C11.7766 19.9634 11.9004 19.9159 12.0115 19.8458C16.5105 17.0099 18.6955 12.7769 17.0925 9.99692ZM3.41659 16.5829C3.221 16.6145 3.02041 16.5877 2.84004 16.5057C2.65967 16.4237 2.50756 16.2902 2.40284 16.122C2.29812 15.9538 2.24545 15.7584 2.25145 15.5603C2.25746 15.3623 2.32188 15.1704 2.4366 15.0089C3.08992 14.133 3.86083 13.3513 4.72758 12.6859L4.75458 12.6649C5.1225 12.3817 5.5043 12.1171 5.89857 11.8719C5.95857 13.0669 6.07157 14.2579 6.22457 15.4459C5.36748 15.9963 4.41518 16.3819 3.41659 16.5829ZM10.7465 9.99992C10.6547 10.2652 10.5492 10.5255 10.4305 10.7799C10.3745 10.8999 10.3125 11.0189 10.2505 11.1379C10.1539 11.3232 10.0502 11.5079 9.93953 11.6919C9.85453 11.8319 9.76753 11.9709 9.67453 12.1099C9.26189 12.7271 8.79036 13.3028 8.26655 13.8289C8.19655 13.8989 8.12355 13.9619 8.05255 14.0289C7.94388 12.9642 7.87355 11.8969 7.84155 10.8269C8.77931 10.3959 9.76681 10.0825 10.7815 9.89392L10.7465 9.99992Z" fill="#0D6EFD"/>
        </svg>',
            "link" => "/category/mangas",
            "elements" => [
                [
                    "name" => "Death Note",
                    "link" => "/category/manga/1"
                ],
                [
                    "name" => "Plastic memories",
                    "link" => "/category/manga/1"
                ],
                [
                    "name" => "Tokyo Ghoul",
                    "link" => "/category/manga/1"
                ],
                [
                    "name" => "Dr. Stone",
                    "link" => "/category/manga/1"
                ],

            ]
        ],
        [
            "name" => "Movies/Cartoons",
            "ico" => '<svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.5 8C19.0304 8 19.5391 7.78929 19.9142 7.41421C20.2893 7.03914 20.5 6.53043 20.5 6C20.5 5.46957 20.2893 4.96086 19.9142 4.58579C19.5391 4.21071 19.0304 4 18.5 4C18.5 3.46957 18.2893 2.96086 17.9142 2.58579C17.5391 2.21071 17.0304 2 16.5 2C15.9696 2 15.4609 2.21071 15.0858 2.58579C14.7107 2.96086 14.5 3.46957 14.5 4C14.5 3.46957 14.2893 2.96086 13.9142 2.58579C13.5391 2.21071 13.0304 2 12.5 2C11.9696 2 11.4609 2.21071 11.0858 2.58579C10.7107 2.96086 10.5 3.46957 10.5 4C10.5 3.46957 10.2893 2.96086 9.91421 2.58579C9.53914 2.21071 9.03043 2 8.5 2C7.96957 2 7.46086 2.21071 7.08579 2.58579C6.71071 2.96086 6.5 3.46957 6.5 4C5.96957 4 5.46086 4.21071 5.08579 4.58579C4.71071 4.96086 4.5 5.46957 4.5 6C4.5 6.53043 4.71071 7.03914 5.08579 7.41421C5.46086 7.78929 5.96957 8 6.5 8M10.5 22L9.5 8M14.5 22L15.5 8" stroke="#0D6EFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M20.5 8C21 8 21.4 8.4 21.3 9L18.7 21C18.6 21.5 18 22 17.5 22H7.5C6.9 22 6.4 21.6 6.3 21L3.7 9C3.6 8.4 4 8 4.5 8H20.5Z" stroke="#0D6EFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            "link" => "/category/books",
            "elements" => [
                [
                    "name" => "Gravity Falls",
                    "link" => "/category/mov-cart/1"
                ], [
                    "name" => "Duck Tales",
                    "link" => "/category/mov-cart/1"
                ], [
                    "name" => "Rick & Morty",
                    "link" => "/category/mov-cart/1"
                ], [
                    "name" => "Sponge Bob",
                    "link" => "/category/mov-cart/1"
                ], [
                    "name" => "Adventure Time",
                    "link" => "/category/mov-cart/1"
                ], [
                    "name" => "Breaking bad",
                    "link" => "/category/mov-cart/1"
                ],

            ]
        ],
        [
            "name" => "Games",
            "ico" => '<svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_97_4528)">
            <path d="M8.29287 8.60571V12.5657M10.2746 10.5857H6.31287" stroke="#0D6EFD" stroke-width="1.71429" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M2.90314 8.93486L2.19686 15.2949C2.09546 16.208 2.31856 17.1277 2.82709 17.893C3.33561 18.6582 4.09714 19.2201 4.97829 19.4803C5.85945 19.7405 6.80406 19.6824 7.64668 19.3161C8.48931 18.9499 9.17623 18.2989 9.58714 17.4772L10.2043 16.2429H15.2957L15.9129 17.4772C16.3244 18.2977 17.0114 18.9474 17.8535 19.3128C18.6956 19.6781 19.6394 19.7358 20.5197 19.4758C21.4001 19.2158 22.1611 18.6546 22.6696 17.8903C23.178 17.126 23.4017 16.2073 23.3014 15.2949L22.5969 8.93486C22.4572 7.67678 21.8585 6.51439 20.9153 5.67019C19.9721 4.826 18.7507 4.3593 17.4849 4.35944H8.01514C6.74933 4.3593 5.52793 4.826 4.58473 5.67019C3.64153 6.51439 3.0428 7.67678 2.90314 8.93486Z" stroke="#0D6EFD" stroke-width="1.71429" stroke-linejoin="round"/>
            <path d="M18.6917 9.45258C18.5838 9.44572 18.4826 9.39803 18.4087 9.31922C18.3347 9.2404 18.2936 9.13638 18.2936 9.02829C18.2936 8.92021 18.3347 8.81618 18.4087 8.73737C18.4826 8.65855 18.5838 8.61087 18.6917 8.60401M18.6917 9.45258C18.7497 9.45627 18.8078 9.44803 18.8625 9.42837C18.9172 9.40872 18.9673 9.37807 19.0096 9.33831C19.052 9.29855 19.0858 9.25052 19.1088 9.1972C19.1319 9.14388 19.1438 9.0864 19.1438 9.02829C19.1438 8.97019 19.1319 8.9127 19.1088 8.85938C19.0858 8.80606 19.052 8.75804 19.0096 8.71828C18.9673 8.67852 18.9172 8.64786 18.8625 8.62821C18.8078 8.60856 18.7497 8.60032 18.6917 8.60401M15.7209 11.5749C15.7277 11.467 15.7754 11.3658 15.8542 11.2918C15.933 11.2179 16.0371 11.1767 16.1451 11.1767C16.2532 11.1767 16.3573 11.2179 16.4361 11.2918C16.5149 11.3658 16.5626 11.467 16.5694 11.5749M15.7209 11.5749C15.7172 11.6328 15.7254 11.691 15.7451 11.7457C15.7647 11.8003 15.7954 11.8504 15.8351 11.8928C15.8749 11.9351 15.9229 11.9689 15.9762 11.992C16.0296 12.0151 16.087 12.027 16.1451 12.027C16.2032 12.027 16.2607 12.0151 16.3141 11.992C16.3674 11.9689 16.4154 11.9351 16.4552 11.8928C16.4949 11.8504 16.5256 11.8003 16.5452 11.7457C16.5649 11.691 16.5731 11.6328 16.5694 11.5749" stroke="#0D6EFD" stroke-width="1.71429" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <defs>
            <clipPath id="clip0_97_4528">
            <rect width="24" height="24" fill="white" transform="translate(0.75)"/>
            </clipPath>
            </defs>
            </svg>',
            "link" => "/category/books",
            "elements" => [
                [
                    "name" => "Warcraft",
                    "link" => "/category/games/1"
                ],[
                    "name" => "Detroit: become human",
                    "link" => "/category/games/1"
                ],[
                    "name" => "Undertale",
                    "link" => "/category/games/1"
                ],

            ]
        ],
    ];
    $originalsCategories = [
        [
            "name" => "Genre",
            "ico" => '',
            "link" => "/category/originals",
            "elements" => [
                [
                    "name" => "For children",
                    "link" => "/category/originals/1"
                ],
                [
                    "name" => "Roman",
                    "link" => "/category/originals/1"
                ],
                [
                    "name" => "Utopia/Anti-utopia",
                    "link" => "/category/originals/1"
                ],
                [
                    "name" => "Fantasy",
                    "link" => "/category/originals/1"
                ],

            ]
        ],
        [
            "name" => "",
            "ico" => '',
            "link" => "/category/originals",
            "elements" => [
                [
                    "name" => "Horror",
                    "link" => "/category/originals/1"
                ],
                [
                    "name" => "Mystery",
                    "link" => "/category/originals/1"
                ],
                [
                    "name" => "Thriller/psycho-thriller",
                    "link" => "/category/originals/1"
                ],
                [
                    "name" => "Essay",
                    "link" => "/category/originals/1"
                ],
            ]
        ],
        [
            "name" => "Other",
            "ico" => '',
            "link" => "/category/original/other",
            "elements" => [
                [
                    "name" => "Science articles",
                    "link" => "/category/originals/1"
                ],
                [
                    "name" => "Computers",
                    "link" => "/category/originals/1"
                ],
                [
                    "name" => "Paid",
                    "link" => "/category/originals/1"
                ]
            ]
        ],
    ];
    $dataFans = [
        "name" => "Popular Fan-fictions",
        "description" => "Fan fictions is a kind of writing written by fans. Usually they include the same scenes and characters.",
        "categories" => $fanCategories
    ];
    $dataOriginals = [
        "name" => "Originals",
        "color"=> "color-standard",
        "description" => "Originals - independent writing written by authors. They include only new and original scenes, characters and the story. ",
        "categories" => $originalsCategories
    ];
    ?>
    <?php echo $twig->render("header.twig", ["user" => $_SESSION["user"], "location" => $_SERVER["PHP_SELF"]]); ?>
    <article class="px-5 py-2 d-flex flex-column gap-2">
        <h1>Welcome to <b>Bukie</b>!</h1>
        <p class="fs-5">The free platform for open-minded writers and authors. Whether you’re beginner without fans or professional writer with huge community, you can find something new.</p>
        <?php echo $twig->render("list.twig", ['list' => $benifits]); ?>
        <h2 class="fw-bold">Navigation</h2>
        <?php echo $twig->render("list.twig", ['list' => $navigation]); ?>
        <h2 class="fw-bold">Local charts</h2>
        <?php echo $twig->render("carousel.twig", ['books' => $localCharts]); ?>
        <h2 class="fw-bold">From beginners</h2>
        <?php

        echo $twig->render("carousel.twig", ['books' => $beginners]);

        echo $twig->render("categories.twig", ['data' => $dataFans]);
        echo $twig->render("categories.twig", ['data' => $dataOriginals]);
        ?>
    </article>
    <?php echo $twig->render("footer.twig"); ?>
</body>

</html>