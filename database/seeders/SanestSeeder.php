<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\PlatinumSeeder;

class SanestSeeder extends  Seeder
{
    public function run(): void
    {
        $gambar = PlatinumSeeder::upload('user_photos', 'public', 'png',
            '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');
        $proof = PlatinumSeeder::upload('user_files', 'public', 'pdf',
            'JVBERi0xLjYNJeLjz9MNCjE0IDAgb2JqDTw8L0xpbmVhcml6ZWQgMS9MIDE2MzYzL08gMTYvRSAxMTI2OS9OIDEvVCAxNjA2MC9IIFsgNDU3IDE1Ml0+Pg1lbmRvYmoNICAgICAgICAgICAgICAgICAgDQoyMSAwIG9iag08PC9EZWNvZGVQYXJtczw8L0NvbHVtbnMgNC9QcmVkaWN0b3IgMTI+Pi9GaWx0ZXIvRmxhdGVEZWNvZGUvSURbPEVGOUE2QjBGODJEODU1NDlBRDMwODA2OTBCQTA5MTBGPjw4MjAyM0RFNEVDQzA0NTQ4OTE3NTVGMjFEREQxMUZGMz5dL0luZGV4WzE0IDExXS9JbmZvIDEzIDAgUi9MZW5ndGggNTQvUHJldiAxNjA2MS9Sb290IDE1IDAgUi9TaXplIDI1L1R5cGUvWFJlZi9XWzEgMiAxXT4+c3RyZWFtDQpo3mJiZBBgYGJgCgQSDF1AgnEPiDgEIhqBhOptIHFtPQMTI8M8kBIGRqb/jNv/AwQYAKxGCOINCmVuZHN0cmVhbQ1lbmRvYmoNc3RhcnR4cmVmDQowDQolJUVPRg0KICAgICAgICANCjI0IDAgb2JqDTw8L0MgNzIvRmlsdGVyL0ZsYXRlRGVjb2RlL0kgOTQvTGVuZ3RoIDY4L1MgMzg+PnN0cmVhbQ0KaN5iYGBgZWBgCmYAAk0pBlTACMQsDBwNAkhirFDMwLCHgQ9IJhimyDMJQFXrsEJoxly4ehYGBts5UFFFgAADAOCZBNYNCmVuZHN0cmVhbQ1lbmRvYmoNMTUgMCBvYmoNPDwvTGFuZyj+/ykvTWFya0luZm88PC9NYXJrZWQgdHJ1ZT4+L01ldGFkYXRhIDIgMCBSL1BhZ2VMYXlvdXQvT25lQ29sdW1uL1BhZ2VzIDEyIDAgUi9TdHJ1Y3RUcmVlUm9vdCA2IDAgUi9UeXBlL0NhdGFsb2c+Pg1lbmRvYmoNMTYgMCBvYmoNPDwvQ29udGVudHMgMTcgMCBSL0Nyb3BCb3hbMC4wIDAuMCA1OTUuMiA4NDEuOTJdL01lZGlhQm94WzAuMCAwLjAgNTk1LjIgODQxLjkyXS9QYXJlbnQgMTIgMCBSL1Jlc291cmNlczw8L0ZvbnQ8PC9UVDAgMjMgMCBSPj4+Pi9Sb3RhdGUgMC9TdHJ1Y3RQYXJlbnRzIDAvVGFicy9TL1R5cGUvUGFnZT4+DWVuZG9iag0xNyAwIG9iag08PC9GaWx0ZXIvRmxhdGVEZWNvZGUvTGVuZ3RoIDEyND4+c3RyZWFtDQpIiSyNuwqDQBRE+/sVU+4Wu3t9RLcQCx+FAcFiOrEIkUAE6/x+NhIYmFPMYTpKWNA0Ye6nAYq27YYeEkhFBr7EqdeiBp/4wwdZDqdpm7pOuUVfleApq1ke1pUVzNu6IsLsduNd9JIv0cf4o10MLA8Z53Q1Ur4CDABjgRw/DQplbmRzdHJlYW0NZW5kb2JqDTE4IDAgb2JqDTw8L0ZpbHRlci9GbGF0ZURlY29kZS9GaXJzdCAxMi9MZW5ndGggMjkwL04gMi9UeXBlL09ialN0bT4+c3RyZWFtDQpo3rSQUWvCMBSF/0oeN4bcJG2sghRaZ9lgk7HWKYgPWQ1tIE0liTD//WKqjj3taeQh5NyPc88JpQgjGiFKJ2g2g8zWQjtEMMEw54cnIZvWoTFL4FEMoxFNGBSKNxZFFIpeuzzvv7YjhnGYIUImNBjswrTgnVSnu+zgens/KFIJT0z94vcgLHkn4PVts16sHgIX1NIZ4eoWlr3puArSeogTYwzPjitZZ7pRAmEoneg+0CSG6nQQAT3HNdKbGdhcWsRTlqa+Y86tOCO/Vy503e+lbmAtdaatvL0Laaybt9xc+/5Y+18LJV74hSCYQXn8dOcUlTmKEKfqV1p6M4EoDvgtpN+1d63dUhwh/K+HJcnfTESGe0xuGo2muzT9FmAAnwSXOw0KZW5kc3RyZWFtDWVuZG9iag0xOSAwIG9iag08PC9GaWx0ZXIvRmxhdGVEZWNvZGUvTGVuZ3RoIDkzNTAvTGVuZ3RoMSAxOTI4Nz4+c3RyZWFtDQpIiWSWeVxU1xXHf+ecOyNRElBQXPHNwICKCoIbuC8ouMSk4IIryCIqKEGKa6oW3ONa00bbT6JtP3WrinGNdcE00cao+aemRhRkBgER95UITO+M1sT0vs+795y7vfu+797zeyAAb2MJBO+NigsNH1azw6xrruk7MTkzKcsjd2k5QL2BRio5N8ew7Gh6DvDsr9sL07KmZY5d4+XtmgDwypuWMT+t5NmUcUDrPIDz01OTUgIDWj8G2jbQHbqn6wrPWlOJ9vtoPzA9M2fewKATl7WfBPi2zpidnPTtxgt6bMSHQEPvzKR5WR753vr5fdbq/saspMzUxGNLVmp/r17PwqzZc3KcnyEciG3nas/KTs3KWub00X6Mfr4XlFpEG2CChylCXdQ9tr4s+SLSuEiXjaDYlZQBXqHbBa/SyDjDQCHerqttkFd3GvDw5QgD9JmrTS6ZBrqe5u5NOncR9IRq+Fy7HtppAA8NJBSR+A0tpqW0nFbTJtpMW2g7FdAhOkrXqYJuk5NbcQT34Hgeywk8gZM5j9fwJj7H10WJpzSRVhIg7aS7RMtcWSyr5SPZINtllxTIN6qlClBRapBymtqYbKb15kZvPWr4oFHNO/38ivyT/Zf5f+pfY3gZTQ1/w2oEGZ2NMCPCiDL6GoONLGO+sdhYZRRaTBYfi5/FsFgtQZbOlghLvGWyZYtlp5WtZquXtYm1qbWlta21vTXE2t0aY02ypgZwgHeAJXC6DTa2edq8bb625rbttj22C7bvbOVBjYN9gtOCFwffCjn1gutqnU733jIQhihsc5NYRes0iU9oG+2nz90kyqmKnnNzDtck4njMGyTO8hWBmF+RCJJumkSWLJB8TWKdbJS/yG45IOdVKxWoeqnBppamQDeJh69JTPVfoklsMzwNH8PPMDSJDppEuBFp9HaTyNEklhjb3CSa/YxEnGW0ZcNrEo01iRZW/9ckEq0pbhJGYOIvSOy2nXeT8HaTyA2uDDn5glwk5LzeOW1d+6d+a32Nq3Q2/99uq1/uDMHrVH/XnRfU79ZXXv2j+nnc4mULHaBd9GfNbjNlvqxxTtR3L2eUzhOAugI9zufVLBvrfX4MrQl/3vFJRXWsq6ZUn0PHOccNl+046fhr2bgy5bii7TRHvCO+tKtDz+IIdeiT5LA4GjsSHF72VvYE+wTAXm3Psy+wZ2srzjXaHm+P01eYe9a+pXoNJapkR8nOkq0lH+trQwkV6zcsvlR8vNjverNrXxWVFT0BzAXmANdZIR1fyEq73WcpRdJ0niGz9HfNdtdkS47k6i+8Wtt6x+ONJEt03aY3ajbJNtFzySG3p3M5BSi9JrXcVGvmN8ebnpr0KTW7bfM+84mfWsxHfmYXuPPqN8eab7y2qlz3T+3mcnPlyxL/l8zf/8K/8GrdP0iZ8pE7KlatUJ2Ur9RKnVSpTLkhD6RE7kmp2FWO+kDNkXLVUXNridawoh36oj+GIBZjMA4TkISpmI58LMcKrMHv8An2YB8O4hBOKch9RWqhPFXXcBHlqMRdPKZG5Ek+1IwCKZhCqAuFUxSNprE0jiZSKs2gD3XMyqdltF7qVU9xqvlyVW6qaDVVxag0FalC1VUVRoeUl1ogD1UXVaa6qblyVs6p6ypfdZZKdVO+psPKW/bJHtkvFWgMxlvwgxeaojnaohvao6OO2u9jOEbiXQRiGnIwAxn4LbLVbK1Fn2IL/og/4TCWUTKu4xIuw4EilKIMt4nwBM9RT/7UnFpSK9yjnhRNvagPxdEglUXvUxbNpEyapePNGFoJH5ToKP0dfHEDbXBLx6NqWHAH/qiCDfcRhAfoQYIOeIoIONGTFELwDIPIGwPoHURTEwymxoihphhKvhhNAYgjC0ZQC8STFaPID8PIwFgKQgK1o/aYSB0xmTpjEnXCFApFIoUhmSKQSt2RQt2oK9IpEh/Su5iplXURjUQexWMlJWA1TcAqGo+PaBLWUyLW0RSspcn4PaXjY5qGzZSG3bQIO2g+tlIGdtFC/I3mYSctQAEtxRFagaM4rVXvDG1CIW2kFAQgWMff3lqP+qkWGE8dkEtDdTzOxl4cpzUYSF5aqUYhjXqgGexogZtYSr/CBkrCH2g6TtBaVNB7eISHqlQVKbsqVw5VrI6pL9QJVajOqFPqqDqivlSn1XF1ku9IZ74roToqt+Z7EiYjpYuES4Rc42/VQXWYy6SIb3I5V/AtrhIb3+ZqCZGO0smtdoESLO11rO/ATyRKevFTfsbPpbf0kUi+L135gXTjh9KdH0kPfiw9tT4MEZKhwhIjIrFaOYeJSYZr1RghfaWf9JcBXCMDVRv+UQbxC66VwRLNdVzPTjpDX2r1OU52KqUyuqm1qIRuaG0+T+fo31RER7RCHaMv6DQV0j/pK/qaztI3dJm+pyv0H/qBrlKxVrBr5KBKusWRHMW9uDcP5EE8hIdyDMfyCB7nVrTxPJEncRIn8hRO45mcwYM5mjO5D6dyCk/jdJ7OU7XuzeCRPEz/D0ym2zyLqnk23eEsussf0D3Opvs8hx5wDj3kX9MjzqXHPJee8Dx6yvPpGS9QFapS3VJV6raq5lD+XP8j7FX71H5VoA6oPerv9C8ezmF8kLvwIfoH96WT3J9O8QCtvwv/y3iVPsdRXPHXb3sPHTZrhwDJQJhNsxsnK1GVVJIyR+GNpF3rMPbqsD0jI5jVriQb40M2lsAHCBtsM5wOCVcCDlfuhF7zRSJJFfwHuUnyIV9TqQQ+JsWp/LpnVrYpkspuz2y/s997/d7rXvEuHxXv8THxPt8jPuB7xYe8ID7i+3BLOc6E85j5AU7wSZZ8ipN8mlP8IKc55AxO6jZ+mNv5Ee7gR7mTH+NV/Div5ktwgmf5CV7D3+K1/G3+FD/Jl/JT/Gl+ms/wZfwMX87P4uT/Dn+Gv8uf5edwH3qer+SzfBV/jz/HL/DV/CK7/BLn+GX+PL/Cir/P1/APOM8/5AL/iL/AP+Z1/BPxS97AX+Sf8pf4Z1zkn3MXv8rdrPlabrLg++mMmKRz4gS9KhaoKY5TFvfbtfRXaqc/4ub2J9xR/kyr6S/UQW+RpF/jgPgtbnG/wz3u97g9/oa+imPr64LpBpGmbnoXd7v3caf5gL5MH9K19B6NiKupKq6ig6KPDokK7RE30T5Rov3iGzQremiv2EDzop/uFoN0WAzREbGJ7hID9JzYR2fFLL0gDtJL4hC9LOboFTFPL4o7aUmEtCgepF+Ih+lX4tHEv2WnXCUzcrVslx2yDXe/GxN/T/wj8c/EO/JmWZEb5WY5Jj3pyx3yVjklAzkoN8kR2ZBDcou8RVZljxyWfXKbrMm6vE1uleNyu5yQo7hDvi1vkl+Rj8tQPiwfld+UT8gz8iH5iHxMHpd75Yw8IY/Kk/KA3CXn5CG5W94uX5DPy7OyKDcke8yX1i7/YflviX8hqrT8Tuv56Nnlt5OXt3B0lO6jPfjOUwNfMz9M+2mORmmKDqH7z4BjN94HcRa8hZNtnA7QGDhm6Ai4T9JOSMzhPQv4fgpoHzQdwQkyipPQaKiB8w5Q56D9mNVk+EcA7QL1BHRuhc4GsAdw9mynCXDMlgafefqpJ0+dfOD+E8fvW7j3nmNHjxy++675uUN3Hjwwu3/f3j137L59186Z6alGfbIW3HbrxC07xn1v+7atY6PD1S2bb940NDjQv7Gy7upse1uXaHa096reqfbuLmq2d2Da0d0ldKpXpy1Sbym6ujTs5YZGvHKfk8v5jsrpkpb5snlqjbDeIvhQASnIQsXQqBoaHvfcchhYIjBjF0ERff0KLZ5p7h3zdKUI6AJ4o4VXwP6PkQdaZOVqqoZho0mJPPAlpynsJNn7kA9PfKUniyqnvCnwNjPUmRsLejHrbM2EuxEa3cUsTeKpb1eLIp6Ne9oNpv1+cBPntR2ji/Q1dVc0D7Rbd12dyqvJqhfmtAiUE8MjHiImak6YUznX9xeX37zScKscdDH1NJU4PdwsidOj495SFv/STo9559ADeoMev3kNaN6SS1SyWDZYgzSAawAaEtiZc+hpht9ZKhEtWKq0CAvX4YXFZVo4QfVFjnDZaKGCXaiEe099UUaUUotbApeJcAsR97qYOwNK1lBeJ0bDscTogyhhZ0rtyVKm1FbqRH/FXhjUOWBeB2+boNc6xSrhNKFzxKIXxUKzreQsWU0jMecCOA1uYQUHyw3bBYqwXuT41vMebB33Xusk6LdvcPSYT3dXucmbi+p8Wg972L1yU2wuBkhtAybyZRdprUujnuENHOQ8sruvu8tkl+upKUf5zUsvDfeXm9ls71DYi0RGrtkEa9ZShaAYRilnEk1lr0eaJvIDdVUJwKJQNhgDQNW3uYGeDIqYutlKWDFZUTPcdFmTE/mmkHl05ZsQt1SnbldTPbpD9axQNtCGiJIylLTq0eKyKOplVXav2BXW1SQysFT1ZpxpvwbduqRqWqoepympB/VyhYBL5SZtLsK3IeTglmJ1B4rUBMMNwz63WZKFWr1m4L4c6j6MSaqvz79AouyGulSrB+Ao+5YZlQhkWdXcBqIMdxG5UYXp+LiRGRv3ws6GaihEuFQKa3Dbceu+E/p1G3HIwzTq7kqe705xc2JT8/n6NF6LLk0GajJCmOr8OG7m44hpcF2IU4NmOfsr7G84qMoNcJin1tAJZFzObfhRylDV9o3/yiQuYHKxp1Z5mL2hBYkYAoAR6pmLwZ0rYMU8AaJ2bZQrWhZM5nk5fbuj7/CLKyw1vTDphm5WXa/MywpvNE+gk5gs1GumOaVM7gExCITrTSKXobAShK2Mg5gsrKyk9xYvUomWKsawNOeNO3qh6ga+GwTAonpyjquT+HWnaya5TNutRv5U0fvxUwtHIUumgBydxgkwXZtSOXRrbYo2ir6xUcI6GvU0OWGoQi1gYr4CZqgv6FRhwPxg7C+q2hQ20azn1qasbAXm2ugYbU5Z5XywcN7GEoFDt5g0r3qIbNQTqLZkfk24NnSvC9G1JtBwZaG+LcCx4Gbdimu3uoZMNkEYMJAPRRFjW94wQt6Ogt5TbE6k8+cxduwrRswZqxWWjXi62mJJ24HJbFHz5etBNM6LEfQPaTfKBC+ZH0B4S8gqx0i7mse8eHus/IARdVobFokBY9uuORZzLXs7InujRVN2dNrRlteZPDZaS9gQkdPGnfNJgDmMjmQS1tzIAcyxlBtTrCNBDMj8lPUpOg5d0z5xUagp8ziLy29U0SMDZR7fN8tn7EJGwqoOI8UmXClD/KRQxCtFo8OMAevCheh2O9LWZkOLXEpeHPg4ekvLb1AUuVz8MTljvDwVV2Vcd1OO3ukXG5FUKu7gLjoqOnd92N42dqAaVC6NPgb3UVWuHi3iELG+nYqiOhh1B5OVoqKoghyKJ/gTq0n1C/MilJbq1wxwZabOMYmMWm9+2tR6/EVIo9ubZpRd1YlGH9aDRnRQI8q03rnRXI1SdqPb7N7OmdY05iUd6duUKej5YpzF0XuuuEKfNzWZbkUyY2jhCjFp1c1HuVGI33PFzCdKhZn/b7FMvJu6zdJMNypk/vdSiWiDBqPtGuRI82DUJ4At1MPQtLbmxGpToZ2FNcCvhWnXwcjrYisRm6MwpWqWzliMBVFuaWNOtG35DhCy4H0zSu0OELOw5k0n4sJYWl6muWKLOwoC7G7PR3kek2PpKDvniz5mFfMEYKmYJ66k/9Be/UFRXVf4vH33vV0WRBYFU0WzsLikoqKLgIBxaDCSShsVGAKKoBUx/EitKFUbVyMOiW5tpomMWjVGrKNk0pjF1qiZjm1tzWgTnWrqH52x/qiJiWZqpuk0tQbZfue+t8u6rlRn0h0+7nv3nnfPueee+51zY81TGhfB+ub0xp7G3D3oCk3Gid4VmpHfepQ41MBihAaNbmcC3FUg/emGqXj3FfQoVrcpoLGAZXSBzxcb5H+m/6MoQEkWl1Tti+zwe7Ef2OtB0Udskb2DZLe5y4NCLXeax8Fe7I8t5vqFc1MMB8B47K/3hMk5spwIc4zs4qMY3vsI+94apIQlmcFvg35rkEfa/Dait6LKi1721AnOJH4FreZOZYxg10ltHONLMs1C18u72y6na890OhtRZxUrqLaQKBs5VTlZ2uaWJOdDwdO4YIHkIXmNeQS1VBlXx7gBuBKcyhSaYlyGXOY9AzlAjK6aMiK/GveKI4HrKdUGVVmQ5IEKn9OZ4MCQz5mIi4a/Q7rXHHPJPmRx3W1K8Qo6cDgNObY+zuIrLYcT+EZmnzzCzre84AVrW+ZAw07+Hizlr3OtTGVX+Ctdq1AsFLv8TmcNKBGdJSnVPh/Sqc/FN6nKKuM/DyljU7gy4CrGlB2Rgjta/2tcCofbgiOBX6bwdSmk7fmgtlZo4wdfUJ1/YVRtHGXKXCPW8CfN78kll6FfuE2lvhrfHNwPU/0jWbFpB17jU6rlDLBkG1sCpsVPPaHNIJUG0xAaR1lFw8cMcw7P0NKFfWijXSQkjB+ZPmSIYmklWytlZnoS3vM4svEv05E4LH/CxKWOVMfoNHfOpNxsT3LSUF1LdaQq7ty83NycSW5Xmp7kCo5Ydd2qnuj7RvqECenpHk/ft9SpvceVRaKwsCC3rLKi7gd71rXvmFWclya0GbffuZSVnp7F2CmO935Z1jxubElu4cyqWd4Nq5tn1U/KLM3B7QrZhsRM7QmKoyQaVhQ7KDaWkvpNdeRnZU+YuMyR6klmA3RXqgPP0jDcZK95Ty5fftLbd0ZJ/9HWbav6LmhP1B19cf3Bmjt/t3R7125ox/xNgZvqG+olGkWPUWqRY7i91eZyDaa4odbWR1MoFlo8HtaT78jOnDDxyTQ3OyI9r3/pWPsoS5LDlaHrGZ7cvByhJw1NVnZW/Lh8rzL21Oq6Rb49iw+1lW58rmintbhnRv3u3L4vP5mXWOStWb9homWad17D91d2TkuZ0dF4p62zdO4LtU+9p9Y2f/sZ0zbYTIn0KI0sSoi3tw6i1uGxNmvrkISQaZ7Mfrt4H4Y5skPGONzSSthzc8WBukVHvM9uz9q/K2bS3u82vzz2mx2LOl5am9h6df++i0vnPm2Ju33s5ZLqjYtKlBVlzcfePnQMFmwiUuZpJTJ2Eg7bhaK3kp09f8bDbs92qGGB0bW/Iis/PyuroEA90+sRHXljxuQxSCHeSbqxecWVusFT/kWxNg5K+uvettvcXvm0ZlSvcud0TJttKF51lsUPX1nX3/kNkd3dq9z6IqZNzhP20xBsiI7DZPt/wboicIkhzpNf20SJmo9aosKLcS8sMiCf9WxKFMvIPwDy/8e4gVeoViynRn7WDlCLWEdlwoN+D1m0N6E7Groh2w170VqSIPtro7UkBW4Cl4FevHcZCFxAuxftf9COQ/uJZR+NZohN+NaEGogK0suga98AuAB7HhJ6WnTcJeejhvB32/PwzS7YusvQKf6C53C8RN+5H7Q5WMufKTES2jJ6fSDotuiIJiveRkyNJRs/W11kiYRooXgxG/EcDcsj3p2UEQ7VQZMfFKKImh4CysPI68cNCC91SWTjORpWA01my9hmtnkDIXBr4HED6r+pzmIP9JnvzQzwe4alkZzqZXpS7UE+5DYCohH2NlIat8p12gRwu0W5HvgU+ADPZPYDgRNof6Kek+8uYDD6zgEfmfhA/Zi6woGztQV41Wy3WJ6SLekfSr0GTgeOhZ7D0WT6615Y7zu26j4Il8mW7RwTTdb0sL3Dfljegt0GGoCN6lVquB9EOdYznpyWLfdCrKStA+LUfRBFVt2F+O+krdofKDYSqo9ieDwaxJqIvnU0LRwYb3pAJD6InFUYCMV4JM7BL2Um1iA2f0o/VJdQubqZymX+Qc5hqO/cA9I0cFwlOcLzhP4ZOOQVKruLe//Yz99aETkkV3ebnNxpciXyF3OdmA+dgHaJZjIXaTp46yj5rTOBNsh1GvboFXLuROtJclj3GLwqc+Cr1GLmmF7OHdo1yGyT3Fskn5upQ5tO8dYmfD8VudWF9gtSrBchM5fKdBetlbx9BXYAMQq1WKcbaxLXQusgrRG8fBp2rCe/bSLmgI3aGSMPy3UEOfIQxes7IDsW69AlevR3cd4AtlP6C/Nq9eSQPnkfgJy+FHrC8n8w7zKCPuYcHDW/wQdBP0pf8nzwl3o+8JV4FvzOfoUc873WBtmrsJP3oA57ifygfU6V7L97+LoZsvHgETUCg8BXE3BWN2PdYRyonQrcUq9RqdiOsSB+1c9FmDMZN4Iu0WFyy9J+vlanIhbNM6LV4h1nStTRGnB0l74f+BPkIK9+Tl1aOZ7fJKf2MSXrY9DHPGByvMmTvcyHzKt6DmQVrAfPOKuE74foQ9CnQs8xzDU6cEs/jznepVLtNZx1tgtVHsPag7xiN9fkgcw/5DrSxFmcHfCT1gK7OjHXz4DXDP3h61B/TzGIA6d4EevgtTCnXsbcl41YYH/hHHYhDpOlT14HIKctkr4K5bbwnBL0MeeWkI8juPUu/uH5ynnf8N1u8BT7FTzAvCUeg7wGGd6DGbQFa2uQY6zjKuYP5z/eQ54Pa5C5YzdtRbtV/wpgHzdL31MkF8l6zuQV5hFxhAold6B+CHKCrBX5nCEWg3WdaKfGcL7AfmQEz1mQK+TZvQSbef5lgbVad2At4hjnOXBQzA4I7VLgIMc1f6POxhwNVBg8O+JDgOtZ9sFZypb658P++QHBrZQxeUratAl1n1F3N1g9qKsO00zmQ7EDsYE1ae2Qfxz1G5+fzYFueYbWY+5a+JX91mTUCGoFLZRxUE9tluQwv75gtLBzodzHXyBuvBhvwfPP8e1ivHcg//DZOAD7EKv6YtrIc1iSA58Bf+PxEDAHj7MNrJd1Wi5AL2Ge7RE1Etu2A3gDNtzA+z/hj/3YJ9jOdrJOaQ/3wSbjnAU+UuONvC3PtJfSOR6gZwPyfZdIpMUiA/mtHvN2UKHlfbpgd8Nf02k+8FtgHvA9YDJQZ/ZzW2+OPaf1geO/Rogq1GiHaYQoRq4rpqel7hJ6RtRQrXqWRoqpsGEuVYLXllguUhHkl0obq+jxkI1laItDNj7oWri9ASww5XKjyVmO0ERgFZAD5AIpQJ7ZPwbINsceSE5J7/udPgz7YgU6KUd7C+0U+i/71RobxXWF73rttXmGkpS3uReDAeP1Lm+yTgg2xk7BQByMixe7hNmd2d2B3ZnNzCwWlZoiNSAUShKJhqpSlNCqSpPQqG6lSEVKRNUffQmrf1JFURu1Uv+06uNf0ypqOv3OmVnvYiBV1PyoKu/VN/fMuWfO+96Z3dn0j+Ae2AmsCu93hXLE24V356ZP2x9x15//G2A0mP91kzjoRxG5FqBhEP8RO8S5hp+IM4z9uN+P+3COXcI8Kt6A3Cs4048QaC36Y/FK9FXkPiXeaFwF/kGxg/YN6r+UcUNkCcRrHg9ANMv8QpwmVNeg/2ngQMOYaAYGgYvhfP6ufPgbfRl4SZynGffnOQbM0WFxnBD5a4CGv4kLke+JC3fwTdHYOCUGQW8h8D4dEO/HPuR5HXrSwTzWbOMbekC80/Qh95ITE+IkAf1+JbZBnMB8snkjzq12PPdFcRB5ydFeiN7EOU97YptY2RzFOf1nkYpMigsNvwU6xC1C9NtY/5n4Nc2xq+JLLTjD+ZlrsPUNsQPn6Rrap/BlGLPHc0CbwGHQp1roW2NAPIAzaRD3Dfxt+CucldcAC981Od6Hx4BHsJ7E9+XLTdtwfnxVrI29zjE9AP4S2lstaT4/TsQ6xXea/gI/BsQQQPv6KP5D0D5aH/175CnUdznoJ6Od4mS0M7KX6Dq8PeOe4AKPAgPhfXsIol9oeg82nhNvkj5+39B5/7XgndT0FHw8x+/gIchcjb0oTs5Jkd+R76J+LwHvAOPh/M36++ZtmPcF+ATn2E3u7csiRXUG/SrweqPwP2gUkbeCuUpH3hLioyeBx7CbVmJrfRTMVdq/2ngq8vvGN/0vY54P/gbgFgDVkXeBPej+PswLgHlAB2AAi4F2AF9UkZ9Cz7eAr4P+OfAMcAn624L9TevTepuB3wV6WR9h+QydvwR6AR0+bQBuATHgXWAPsACYB3QABrAYaAeeAS7h3Co2XsS3B333wzt89/NMfYKQ76/hnz7wARAJ5z/h/HkPcbzN7+6675jAT3pG/OHjnoeNG5B5YnbweO5/brz/347I6k957J0ds2N2zI7ZMTtmx//fEPg6bGoWPxKLRFm0iAbMSbAiDQfv+wruQYr54irP+EUfpA/mgBTzcRfQjaD3hXQM9FBIN4tUdBySkcY5WChHXwjpiFg2tymkG8TCua0hHQW/M6QbQfeFdAz0WEg3C2eu+5raunnrdnXIzDq2a+c81Wc7ZdvRPNO2Eqq3WFRHzHzBc9URwzWcM4aeUEcLhmo7bThWm/K0TNFQdk55BdNVOdvy1ITmKt04YxTtsqEr01JlzfFUxTWtvNKU61X0sypzVvVauvOsGqhkC66yLTxvKMcoGmc0K8sKST89UtZMx1UbC55XdruTybzpFSqZRNYuJTVoMLpypCEZSnexdDJTtDPJkuZ6hpM8uL+v//Bwf6KkdyQQW/msQ+Eg6C2peh8SashwSqbrImyFUAqGY8DLvKNZnqHHVc4x2K1sQXPyRlx5ttKss6psOC4esDOeZlpBhFnYmM4IZXRCcwwI60pzXTtratCndDtbKRmWx2lWObNoIEbKQdtw+ERbBxvRDa1ISaS16pKaQBLsioeEuZ5jZklHHELZYkUnH6rLRbNkhhY4vUEdobTiIgLyM65Ktm7maDY4rHIlUzTdQlzpJqnOVDwwXWJmDYueQhxJ21GugcaABhN+c6w171iGrJQpoV6YIrY7UbBLt0dCTVNB6dyCwc/oNlLGFk8ZWY84JJ6zi0V7gkLL2pZuUkRuN7ehlrHPGBxKUFbL9uBp4AHlv1wrarjkFjS4njHCfAUtqtVF45B110PdTaQeW4HNzYwycWho9Fj/SGdv2bPde9F8oRg15TmabpQ053RVUW3D5R27UubesktlzYITCfGaUGKr2AxsB3VImCIrHGELF8gJD7w+UA4OGrpq4JigLJHASq8oYihxBLy8KGDN5TsDswHpM7jqLHkUqwbmNnGaVyxQCvKayEADrZA14hSgi7Tk2ArZn4AUcXTIkcYiVsqsWUHWwrUMCYdlK5AkXh60BrjgViB5FnSGr71Y1SH9R9ADWMvCosv2rdA+eeOwHbKngZ+t87Dqf9UK2TbBIR0bOQceeK7oFkmMPNZIZwXWE9BjixK4WuiDIbqgs+pDcoburjrdSc6TjWsSGjSOi2ST4qDYjwr1i8NiGNcEVnXRwTnv4zydhVS1OkGlt4jUPfNAzw2x5hLXwQ2rrcKqFHjNCHOZ546w2BddxLlqtFrLFmml2uTBi3N+ba6Mxc+XWZsbWqDoPI7Yuq2G2TCOO3uk2qMTbMMINes8u7yahaQW+kcdRJwKYjPY61o3k+cmVzyoozfdr8MzbLQhu7VIqCc13gPmbf0z8ynq4qATbNj3wg6jKjq846p+xENNWeikvq3mYebTRdyXmFcfQ6176/dj4GmF92S8Lp9El0CTldz0vVFXrTL3bZGzXWCOznTgdYZ9CSTdacks57ZqK6hHks8OxdzgxAh8MMN81+p6t9zF6+oaxFKe7lBvRhfV4p3gbJU+tibVk6YS7jqXJWt2dL6S5lqMpyCRZbuBTFU7nVdF3qMT01XLsk86+2mG/nXXnYZ0+tl8ptWqUr9bLfC8MKf1Oaj2fy0P9Tv19qdc3oFB1jNh1LX+qj9FtXvUxpmO3eV+s1h70PXBW6EW3X+qZQJvmCExKo7hrBoRnTiFypxHl98aeVgpsuS9pD4pv0ZVq62xd3RuUfQltnb6Dr/v9h7M830FGmunG3VYmXMS5CuBD17++S/irL3Lr8d/YrMvT2zx5ReSjhxPXpFjSV8eT/gynZiSo3FfHuvy5ee7puRIpy+PdhyQwx2+PLLJl49vui6HOpR8bGO/PLzxujy00ZcHN/hycL0vD6zvlPvX5eXn1k3JR9f5cqDdl/3t1+W+tb7sa/Pl3jVTsneNL3vWXJd71JR8RPlyt7oiH1ZJ+dBqR3av9mVK+vJBeU7uanXkzlZf7midkttXTcltq3y5ddV1uWWzIxPx3bIr7shNHSdkO2ytW7Fy+fjath7ZFl2xfHzNit1SPQxCrs7L1R3Lloy3LvXlqiW+XLljeffYsp1LusdW9AwRvZTozy5/aEnh+P2pxSOfSS0aWZxelF6Qmj/SlGoYaQTmp+/buXBkXmruSHMqNrIwPTcdS4v0nFTLSBSrLemG9CIR7elpityIPC+Odg7+sNk/MjjZMjQ2Gbk42T5M157Hj0/GLk6KkeNjo9+PRJ5Nn798WbTuHZx8fnj0ByhU6970v7WRick5MGIjC3NfpBMw5WhrazNAIZgJ5WtrMyJBBiAGIQZtCAMiD1UOZcM52jClUHEUGQmAAAMA4TKo5A0KZW5kc3RyZWFtDWVuZG9iag0yMCAwIG9iag08PC9GaWx0ZXIvRmxhdGVEZWNvZGUvTGVuZ3RoIDI1MD4+c3RyZWFtDQpIiVxQTWvEIBC9+yvmuHtYTMKmsCCBsqWQQz9o2h9gdJIKjYoxh/z7jrpsoQM6b5h54/Pxa//UWxOBvwenBowwGasDrm4LCmHE2VhWN6CNircq32qRnnEiD/sacent5JgQwD+oucaww+FRuxGPjL8FjcHYGQ5f1+EIfNi8/8EFbYQKug40TrToRfpXuSDwTDv1mvom7ifi/E187h6hyXVdxCincfVSYZB2RiYqig7EM0XH0Op//bawxkl9y8BEk2arihITbcFtwg91xpQInws+J3wp+JJ337akV8gMuH9BbSGQ+uxYlp0EG4t3U73zQKx02K8AAwBScXh2DQplbmRzdHJlYW0NZW5kb2JqDTEgMCBvYmoNPDwvRmlsdGVyL0ZsYXRlRGVjb2RlL0ZpcnN0IDM1L0xlbmd0aCAyNzEvTiA2L1R5cGUvT2JqU3RtPj5zdHJlYW0NCmjeVFBda8JAEPwr+w82R6hakICfUKRWjH0SH864TY7Gu+PcgPn33ZwxbV9ub2aHYXZGkMAYJilMQCkFr6DSBFQC6Yt8FaSjMUynuBFNAnvc6UCWD4FI9P+JLd15Qy0o3Lua3rUXr05xaD1hzqEpomzvHGdZtBT7aAGjOHPMqXjsts31dowxZHGK1Mxax5qNs5h7bXEW2HzpgnGHc3OujSuD9lXbgZXl0OKi0oFxbcomEC6Nlv11gMH5hfZPuLIXMSfcds9aAv6iN1sbS3ml5Yhe/dFwxz1iyGHmm1zDPWzOtyIYP0BP4S9xkJLm7t6lx097oTA4Zdnx0ccpdpNILX3lJahnQbss+xFgANhviU0NCmVuZHN0cmVhbQ1lbmRvYmoNMiAwIG9iag08PC9MZW5ndGggMzkxOS9TdWJ0eXBlL1hNTC9UeXBlL01ldGFkYXRhPj5zdHJlYW0NCjw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+Cjx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDcuMS1jMDAwIDc5LjQyNWRjODcsIDIwMjEvMTAvMjctMTY6MjA6MzIgICAgICAgICI+CiAgIDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+CiAgICAgIDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiCiAgICAgICAgICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgICAgICAgICAgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iCiAgICAgICAgICAgIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIKICAgICAgICAgICAgeG1sbnM6cGRmPSJodHRwOi8vbnMuYWRvYmUuY29tL3BkZi8xLjMvIgogICAgICAgICAgICB4bWxuczpwZGZ4PSJodHRwOi8vbnMuYWRvYmUuY29tL3BkZngvMS4zLyI+CiAgICAgICAgIDx4bXA6TW9kaWZ5RGF0ZT4yMDI0LTA2LTAzVDA4OjQ0OjMzKzA4OjAwPC94bXA6TW9kaWZ5RGF0ZT4KICAgICAgICAgPHhtcDpDcmVhdGVEYXRlPjIwMjQtMDYtMDNUMDg6NDQ6MzIrMDg6MDA8L3htcDpDcmVhdGVEYXRlPgogICAgICAgICA8eG1wOk1ldGFkYXRhRGF0ZT4yMDI0LTA2LTAzVDA4OjQ0OjMzKzA4OjAwPC94bXA6TWV0YWRhdGFEYXRlPgogICAgICAgICA8eG1wOkNyZWF0b3JUb29sPkFjcm9iYXQgUERGTWFrZXIgMjIgZm9yIFdvcmQ8L3htcDpDcmVhdG9yVG9vbD4KICAgICAgICAgPHhtcE1NOkRvY3VtZW50SUQ+dXVpZDowZDg3MDJhMS04YjRjLTRlMTYtODMwZi00ZGVkYWQ4N2ZlYTU8L3htcE1NOkRvY3VtZW50SUQ+CiAgICAgICAgIDx4bXBNTTpJbnN0YW5jZUlEPnV1aWQ6YzQxNDFmY2ItNjM4ZS00ZWJkLTk3YjQtMmJiZjM0MTVlZmQyPC94bXBNTTpJbnN0YW5jZUlEPgogICAgICAgICA8eG1wTU06c3ViamVjdD4KICAgICAgICAgICAgPHJkZjpTZXE+CiAgICAgICAgICAgICAgIDxyZGY6bGk+MTwvcmRmOmxpPgogICAgICAgICAgICA8L3JkZjpTZXE+CiAgICAgICAgIDwveG1wTU06c3ViamVjdD4KICAgICAgICAgPGRjOmZvcm1hdD5hcHBsaWNhdGlvbi9wZGY8L2RjOmZvcm1hdD4KICAgICAgICAgPGRjOnRpdGxlPgogICAgICAgICAgICA8cmRmOkFsdD4KICAgICAgICAgICAgICAgPHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ii8+CiAgICAgICAgICAgIDwvcmRmOkFsdD4KICAgICAgICAgPC9kYzp0aXRsZT4KICAgICAgICAgPGRjOmRlc2NyaXB0aW9uPgogICAgICAgICAgICA8cmRmOkFsdD4KICAgICAgICAgICAgICAgPHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ii8+CiAgICAgICAgICAgIDwvcmRmOkFsdD4KICAgICAgICAgPC9kYzpkZXNjcmlwdGlvbj4KICAgICAgICAgPGRjOmNyZWF0b3I+CiAgICAgICAgICAgIDxyZGY6U2VxPgogICAgICAgICAgICAgICA8cmRmOmxpPk5heiBBbWlydWw8L3JkZjpsaT4KICAgICAgICAgICAgPC9yZGY6U2VxPgogICAgICAgICA8L2RjOmNyZWF0b3I+CiAgICAgICAgIDxwZGY6UHJvZHVjZXI+QWRvYmUgUERGIExpYnJhcnkgMjIuMS4xMTc8L3BkZjpQcm9kdWNlcj4KICAgICAgICAgPHBkZjpLZXl3b3Jkcy8+CiAgICAgICAgIDxwZGZ4OlNvdXJjZU1vZGlmaWVkPkQ6MjAyNDA2MDMwMDQzNTI8L3BkZng6U291cmNlTW9kaWZpZWQ+CiAgICAgICAgIDxwZGZ4OkNvbXBhbnkvPgogICAgICAgICA8cGRmeDpDb21tZW50cy8+CiAgICAgIDwvcmRmOkRlc2NyaXB0aW9uPgogICA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgCjw/eHBhY2tldCBlbmQ9InciPz4NCmVuZHN0cmVhbQ1lbmRvYmoNMyAwIG9iag08PC9GaWx0ZXIvRmxhdGVEZWNvZGUvRmlyc3QgNS9MZW5ndGggNTAvTiAxL1R5cGUvT2JqU3RtPj5zdHJlYW0NCmjeMjRSMFCwsdF3zi/NK1Ew1PfOTCmONjQDCgbF6odUFqTqBySmpxbb2QEEGADnMAvcDQplbmRzdHJlYW0NZW5kb2JqDTQgMCBvYmoNPDwvRmlsdGVyL0ZsYXRlRGVjb2RlL0ZpcnN0IDUvTGVuZ3RoIDE5Ni9OIDEvVHlwZS9PYmpTdG0+PnN0cmVhbQ0KaN5szU2LwjAUheG/kp0tgr1NqlNEhGJx4wfCCLNOmytGba9cE6T+elORwYW7d3F4TqoEiNksKbw7Ekdb/RBFY9lf4mRBTYOtu0WvvOq264tRO0ttqR1G5VSCzGACCvIsU3II+QBg8F4FrqiZKu3Erlxu9BlZSCkOxOKP2MTJCrt7iP5gQ+abqP7FHZPxNQbSUIU9KNa2Ys1dMEfpKE1/4uSXPNcYLHuwaD4xyNRYhoGvTli7cLi37oJRPJ8/BRgA0iZLtg0KZW5kc3RyZWFtDWVuZG9iag01IDAgb2JqDTw8L0RlY29kZVBhcm1zPDwvQ29sdW1ucyA0L1ByZWRpY3RvciAxMj4+L0ZpbHRlci9GbGF0ZURlY29kZS9JRFs8RUY5QTZCMEY4MkQ4NTU0OUFEMzA4MDY5MEJBMDkxMEY+PDgyMDIzREU0RUNDMDQ1NDg5MTc1NUYyMURERDExRkYzPl0vSW5mbyAxMyAwIFIvTGVuZ3RoIDQ4L1Jvb3QgMTUgMCBSL1NpemUgMTQvVHlwZS9YUmVmL1dbMSAyIDFdPj5zdHJlYW0NCmjeYmIAAiZGHVYGJgbGXCAhMAdIMPSBuIpAiUMuIC4DIw6C6TeQYGQACDAAmPIEIw0KZW5kc3RyZWFtDWVuZG9iag1zdGFydHhyZWYNCjExNg0KJSVFT0YNCg==');


        User::create([
            'username' => 'Platinum 1',
            'email' => 'a',
            'password' => Hash::make('1'),
            'user_type' => Roles::PLATINUM
        ])->platinum()->create([
            'plat_name' => 'John Smith',
            'plat_ic' => '123456789012',
            'plat_title' => 'Mr.',
            'plat_gender' => 1,
            'plat_religion' => 'Christian',
            'plat_race' => 'Caucasian',
            'plat_citizenship' => 'American',
            'plat_photo' => $gambar,
            'plat_address' => '456 Another St',
            'plat_address2' => 'Suite 100',
            'plat_city' => 'Los Angeles',
            'plat_state' => 'CA',
            'plat_postcode' => '90001',
            'plat_country' => 'USA',
            'plat_phone_no' => '9876543210',
            'plat_email' => 'john.smith@example.com',
            'plat_fbname' => 'johnsmith',
            'plat_cur_edu_level' => 'Masters',
            'plat_edu_field' => 'Electrical Engineering',
            'plat_edu_institute' => 'UCLA',
            'plat_occupation' => 'Electrical Engineer',
            'plat_study_sponsor' => 'Scholarship',
            'plat_discover_type' => 'Online',
            'plat_prog_interest' => 2,
            'plat_batch' => '2025',
            'plat_has_referral' => 0,
            'plat_referral_name' => null,
            'plat_referral_batch' => null,
            'plat_tshirt' => 'L',
            'plat_app_confirm' => 1,
            'plat_app_confirm_date' => now(),
            'plat_payment_type' => 2,
            'plat_payment_proof' => $proof,
        ]);

        User::create([
            'username' => 'Platinum 2',
            'email' => 'b',
            'password' => Hash::make('1'),
            'user_type' => Roles::PLATINUM
        ])->platinum()->create([
            'plat_photo' => $gambar,
            'plat_payment_proof' => $proof,
            'plat_name' => 'John Doe',
            'plat_ic' => strval(1985082412345678),
            'plat_title' => 'Mr.',
            'plat_gender' => rand(0, 1),
            'plat_religion' => 'Christian',
            'plat_race' => 'Asian',
            'plat_citizenship' => 'United States',
            'plat_address' => '123 Sunny Street',
            'plat_address2' => 'Apt 4B',
            'plat_city' => 'New York',
            'plat_state' => 'NY',
            'plat_postcode' => '10001',
            'plat_country' => 'US',
            'plat_phone_no' => strval(1234567890),
            'plat_email' => 'john.doe@example.com',
            'plat_fbname' => 'john.doe',
            'plat_cur_edu_level' => 'Bachelor',
            'plat_edu_field' => 'Computer Science',
            'plat_edu_institute' => 'NYU',
            'plat_occupation' => 'Software Engineer',
            'plat_study_sponsor' => 'Parents',
            'plat_discover_type' => 'Web',
            'plat_prog_interest' => rand(0, 1),
            'plat_batch' => '2024',
            'plat_has_referral' => rand(0, 1),
            'plat_referral_name' => 'Jane Smith',
            'plat_referral_batch' => '2023',
            'plat_tshirt' => 'M',
            'plat_app_confirm' => rand(0, 1),
            'plat_app_confirm_date' => Carbon::now(),
            'plat_payment_type' => rand(0, 1),
        ]);

        User::create([
            'username' => 'Platinum 3',
            'email' => 'c',
            'password' => Hash::make('1'),
            'user_type' => Roles::PLATINUM
        ])->platinum()->create([
            'plat_name' => 'Alice Johnson',
            'plat_ic' => '020202020202',
            'plat_title' => 'Mrs.',
            'plat_gender' => 2,
            'plat_religion' => 'Islam',
            'plat_race' => 'African American',
            'plat_citizenship' => 'Canadian',
            'plat_address' => '456 Elm St',
            'plat_address2' => 'Suite 300',
            'plat_city' => 'Toronto',
            'plat_state' => 'ON',
            'plat_postcode' => 'M5H 2N2',
            'plat_country' => 'Canada',
            'plat_phone_no' => '9876543210',
            'plat_email' => 'alice.johnson@example.com',
            'plat_fbname' => 'alicejohnson',
            'plat_cur_edu_level' => 'Master',
            'plat_edu_field' => 'Electrical Engineering',
            'plat_edu_institute' => 'University of Toronto',
            'plat_occupation' => 'Electrical Engineer',
            'plat_study_sponsor' => 'Scholarship',
            'plat_discover_type' => 'Social Media',
            'plat_prog_interest' => 2,
            'plat_batch' => '2025',
            'plat_has_referral' => 1,
            'plat_referral_name' => 'Michael Brown',
            'plat_referral_batch' => '2022',
            'plat_tshirt' => 'L',
            'plat_app_confirm' => 1,
            'plat_app_confirm_date' => '2024-06-21',
            'plat_payment_type' => 2,
            'plat_payment_proof' => $proof,
            'plat_photo' => $gambar
        ]);

        User::create([
            'username' => 'Platinum 4',
            'email' => 'd',
            'password' => Hash::make('1'),
            'user_type' => Roles::PLATINUM
        ])->platinum()->create([
            'plat_name' => 'Bob Smith',
            'plat_ic' => '030303030303',
            'plat_title' => 'Mr.',
            'plat_gender' => 1,
            'plat_religion' => 'Hindu',
            'plat_race' => 'Indian',
            'plat_citizenship' => 'British',
            'plat_address' => '789 Oak St',
            'plat_address2' => 'Floor 2',
            'plat_city' => 'London',
            'plat_state' => 'London',
            'plat_postcode' => 'SW1A 1AA',
            'plat_country' => 'UK',
            'plat_phone_no' => '1122334455',
            'plat_email' => 'bob.smith@example.com',
            'plat_fbname' => 'bobsmith',
            'plat_cur_edu_level' => 'Doctorate',
            'plat_edu_field' => 'Biochemistry',
            'plat_edu_institute' => 'University of Oxford',
            'plat_occupation' => 'Research Scientist',
            'plat_study_sponsor' => 'Government Grant',
            'plat_discover_type' => 'Advertisement',
            'plat_prog_interest' => 3,
            'plat_batch' => '2023',
            'plat_has_referral' => 0,
            'plat_referral_name' => null,
            'plat_referral_batch' => null,
            'plat_tshirt' => 'XL',
            'plat_app_confirm' => 1,
            'plat_app_confirm_date' => '2024-06-22',
            'plat_payment_type' => 1,
            'plat_payment_proof' => $proof,
            'plat_photo' => $gambar
        ]);
        User::create([
            'username' => 'Platinum 5',
            'email' => 'e',
            'password' => Hash::make('1'),
            'user_type' => Roles::PLATINUM
        ])->platinum()->create([
            'plat_name' => 'Robert Williams',
            'plat_ic' => '030303030303',
            'plat_title' => 'Mr.',
            'plat_gender' => 1,
            'plat_religion' => 'Hindu',
            'plat_race' => 'Indian',
            'plat_citizenship' => 'British',
            'plat_address' => '789 Pine St',
            'plat_address2' => 'Floor 2',
            'plat_city' => 'London',
            'plat_state' => 'ENG',
            'plat_postcode' => 'WC2N 5DU',
            'plat_country' => 'UK',
            'plat_phone_no' => '0123456789',
            'plat_email' => 'robert.williams@example.com',
            'plat_fbname' => 'robertwilliams',
            'plat_cur_edu_level' => 'PhD',
            'plat_edu_field' => 'Physics',
            'plat_edu_institute' => 'University of Oxford',
            'plat_occupation' => 'Research Scientist',
            'plat_study_sponsor' => 'Government Grant',
            'plat_discover_type' => 'Advertisement',
            'plat_prog_interest' => 3,
            'plat_batch' => '2023',
            'plat_has_referral' => 0,
            'plat_referral_name' => null,
            'plat_referral_batch' => null,
            'plat_tshirt' => 'XL',
            'plat_app_confirm' => 1,
            'plat_app_confirm_date' => '2024-06-21',
            'plat_payment_type' => 1,
            'plat_payment_proof' => $proof,
            'plat_photo' => $gambar
        ]);
        User::create([
            'username' => 'Platinum 6',
            'email' => 'f',
            'password' => Hash::make('1'),
            'user_type' => Roles::PLATINUM
        ])->platinum()->create([
            'plat_name' => 'Emily Davis',
            'plat_ic' => '040404040404',
            'plat_title' => 'Dr.',
            'plat_gender' => 2,
            'plat_religion' => 'Buddhist',
            'plat_race' => 'Caucasian',
            'plat_citizenship' => 'Australian',
            'plat_address' => '321 Maple St',
            'plat_address2' => 'Unit 5',
            'plat_city' => 'Sydney',
            'plat_state' => 'NSW',
            'plat_postcode' => '2000',
            'plat_country' => 'Australia',
            'plat_phone_no' => '0987654321',
            'plat_email' => 'emily.davis@example.com',
            'plat_fbname' => 'emilydavis',
            'plat_cur_edu_level' => 'High School',
            'plat_edu_field' => 'Biology',
            'plat_edu_institute' => 'Sydney High School',
            'plat_occupation' => 'Teacher',
            'plat_study_sponsor' => 'Family',
            'plat_discover_type' => 'Event',
            'plat_prog_interest' => 0,
            'plat_batch' => '2026',
            'plat_has_referral' => 1,
            'plat_referral_name' => 'Sarah Lee',
            'plat_referral_batch' => '2024',
            'plat_tshirt' => 'S',
            'plat_app_confirm' => 1,
            'plat_app_confirm_date' => '2024-06-21',
            'plat_payment_type' => 1,
            'plat_payment_proof' => $proof,
            'plat_photo' => $gambar
        ]);
    }
}
