'use client';

import Link from 'next/link';
import {useEffect, useState} from 'react';
import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarGroup,
  SidebarHeader,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
  SidebarProvider,
  SidebarTrigger,
} from '@/components/ui/sidebar';
import NewsAggregator from '@/components/news-aggregator';
import {Icons} from '@/components/icons';
import {Card, CardContent, CardDescription, CardHeader, CardTitle} from '@/components/ui/card';
import {Avatar, AvatarFallback, AvatarImage} from '@/components/ui/avatar';
import {useRouter} from 'next/navigation';

export default function Home() {
  const [isSettingsOpen, setIsSettingsOpen] = useState(false);
  const router = useRouter();

  useEffect(() => {
    console.log('API Key:', process.env.GOOGLE_GENAI_API_KEY);
  }, []);

  return (
    <SidebarProvider>
      <Sidebar>
        <SidebarHeader>
          <Link href="/">
            <Icons.logo className="h-8 w-auto" />
            <span className="sr-only">Sintoniza+</span>
          </Link>
        </SidebarHeader>
        <SidebarContent>
          <SidebarMenu>
            <SidebarMenuItem>
              <SidebarMenuButton onClick={() => router.push('/artists')}>
                <Icons.user className="mr-2 h-4 w-4" />
                <span>Artists</span>
              </SidebarMenuButton>
            </SidebarMenuItem>
            <SidebarMenuItem>
              <SidebarMenuButton onClick={() => router.push('/radios')}>
                <Icons.messageSquare className="mr-2 h-4 w-4" />
                <span>Radios</span>
              </SidebarMenuButton>
            </SidebarMenuItem>
            <SidebarMenuItem>
              <SidebarMenuButton onClick={() => router.push('/promotions')}>
                <Icons.share className="mr-2 h-4 w-4" />
                <span>Promotions</span>
              </SidebarMenuButton>
            </SidebarMenuItem>
          </SidebarMenu>
        </SidebarContent>
        <SidebarFooter>
          <p className="text-center text-xs ">
            &copy; {new Date().getFullYear()} Sintoniza+
          </p>
        </SidebarFooter>
      </Sidebar>
      <div className="flex-1 p-6">
        <h1 className="text-4xl font-bold text-center mb-8">Sintoniza+</h1>
        <section className="mb-12">
          <p className="text-lg text-gray-700 text-center">
            Welcome to Sintoniza+, your hub for local radios, independent artists, and
            users seeking relevant local content.
          </p>
        </section>
        <section className="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div className="bg-gray-100 p-6 rounded-lg shadow">
            <h2 className="text-xl font-semibold mb-2">News and Content Aggregator</h2>
            <p className="text-gray-600">Stay updated with the latest news and content from local radios.</p>
          </div>
          <div className="bg-gray-100 p-6 rounded-lg shadow">
            <h2 className="text-xl font-semibold mb-2">Artist Directory</h2>
            <p className="text-gray-600">Discover and explore a directory of talented independent artists.</p>
          </div>
          <div className="bg-gray-100 p-6 rounded-lg shadow">
            <h2 className="text-xl font-semibold mb-2">Musical Highlights</h2>
            <p className="text-gray-600">Check out new releases and our curated weekly playlists.</p>
          </div>
          <div className="bg-gray-100 p-6 rounded-lg shadow">
            <h2 className="text-xl font-semibold mb-2">Promotions and Advertising</h2>
            <p className="text-gray-600">Find local promotions and advertising opportunities.</p>
          </div>
        </section>
        <section className="mt-12">
          <h2 className="text-2xl font-bold mb-4">Notícias Locais</h2>
          <NewsAggregator />
        </section>
      </div>
    </SidebarProvider>
  );
}
