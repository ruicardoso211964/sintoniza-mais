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
          <p className="text-center text-xs">
            &copy; {new Date().getFullYear()} Sintoniza+
          </p>
        </SidebarFooter>
      </Sidebar>
      <div className="flex-1 p-4">
        <h1 className="text-2xl font-bold">Welcome to Sintoniza+ Local Pulse</h1>
        <p className="text-muted-foreground">Explore local radio, artists, and promotions.</p>
        <Card>
          <CardHeader>
            <CardTitle>Getting Started</CardTitle>
            <CardDescription>Take a look at src/app/page.tsx.</CardDescription>
          </CardHeader>
          <CardContent>
            <p>This is a NextJS starter in Firebase Studio.</p>
          </CardContent>
        </Card>
      </div>
    </SidebarProvider>
  );
}
